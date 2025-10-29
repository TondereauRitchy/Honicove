<?php

namespace App\Controllers;

use App\Entity\Cart;
use App\Repository\CartRepository;
use App\Resources\Resource;
use SessionManager;

class CartController extends BaseController {


	public function index() {
		try {
			// Utiliser SessionManager pour récupérer l'utilisateur/session actuel au lieu des paramètres GET
			require_once __DIR__ . '/../../../../includes/SessionManager.class.php';
			$sessionManager = SessionManager::getInstance();

			$userId = $sessionManager->getUserId();
			$sessionId = $sessionManager->getGuestSession();

			error_log("CartController::index - userId: " . ($userId ?? 'null') . ", sessionId: " . ($sessionId ?? 'null'));

			if (!$userId && !$sessionId) {
				return $this->sendError("Authentication required", [], 401);
			}

			$conditionColumns = [];
			$params = [];
			if ($userId) {
				$conditionColumns[] = 'user_id';
				$params[] = (int)$userId;
			} elseif ($sessionId) {
				$conditionColumns[] = 'session_id';
				$params[] = (string)$sessionId;
			}

			error_log("CartController::index - conditionColumns: " . implode(',', $conditionColumns));
			error_log("CartController::index - params: " . implode(',', $params));

			$carts = CartRepository::findOrWhere($conditionColumns, $params);

			error_log("CartController::index - carts found: " . count($carts));

			// Enrichir avec les détails des produits
			$enrichedCarts = [];
			foreach ($carts as $cart) {
				try {
					$product = \App\Repository\ProductRepository::find($cart->product_id);
					if ($product) {
						$cart->product_name = $product->name;
						$cart->product_price = $product->price;
						// Utiliser l'image spécifique au panier si elle existe, sinon récupérer depuis product_images ou image_1
						if (!empty($cart->image)) {
							$cart->product_image = $cart->image;
						} else {
							$images = \App\Repository\ProductImageRepository::findWhere(['product_id'], [$product->id]);
							if (!empty($images)) {
								$cart->product_image = $images[0]->image_path;
							} else {
								$cart->product_image = $product->image_1;
							}
						}
					} else {
						error_log("CartController::index - Product not found for cart item: " . $cart->product_id);
					}
				} catch (\Exception $e) {
					error_log("CartController::index - Error enriching cart item: " . $e->getMessage());
				}
				$enrichedCarts[] = $cart;
			}

			error_log("CartController::index - enriched carts: " . count($enrichedCarts));

			return $this->sendResponse($enrichedCarts);
		} catch (\Exception $e) {
			error_log("CartController::index - Exception: " . $e->getMessage());
			error_log("CartController::index - Stack trace: " . $e->getTraceAsString());
			return $this->sendError("Internal server error", $e->getMessage(), 500);
		}
	}


	public function search($id) {
		$data = json_decode(file_get_contents("php://input"), true);
		$cart = CartRepository::findOrFail($id);
		return $this->sendResponse($cart);
	}


	public function store() {
		$data = json_decode(file_get_contents("php://input"), true);
		error_log("CartController::store - Received data: " . json_encode($data));

		// Utiliser SessionManager pour récupérer l'utilisateur/session actuel
		require_once __DIR__ . '/../../../../includes/SessionManager.class.php';
		$sessionManager = SessionManager::getInstance();

		$userId = $sessionManager->getUserId();
		$sessionId = $sessionManager->getGuestSession();

		if (!$userId && !$sessionId) {
			return $this->sendError("Authentication required", [], 401);
		}

		// Traiter les types de données
		if ($userId) $userId = (int)$userId; // user_id comme entier
		if ($sessionId) $sessionId = (string)$sessionId; // session_id comme chaîne

		// Gestion des sessions pour les invités
		if (!$userId && $sessionId) {
			// Vérifier si la session existe
			$existingSession = \App\Repository\SessionRepository::findWhere(['session_id'], [$sessionId]);
			if (empty($existingSession)) {
				// Créer une nouvelle session pour l'invité
				$sessionData = [
					'session_id' => $sessionId,
					'user_id' => null, // Invité
					'data' => null,
					'updated_at' => date('Y-m-d H:i:s')
				];
				$session = Resource::loadEntity($sessionData, \App\Entity\Session::class);
				\App\Repository\SessionRepository::save($session);
			}
		}

		// Vérifier si le produit existe
		$product = \App\Repository\ProductRepository::find($data['product_id']);
		if (!$product) {
			return $this->sendError("Product not found", [], 404);
		}

		// Chercher un panier existant pour le même produit, variantes et utilisateur/session
		$conditions = ['product_id' => $data['product_id']];
		if ($userId) $conditions['user_id'] = $userId;
		if ($sessionId) $conditions['session_id'] = $sessionId;
		// Inclure les variantes pour différencier les articles
		if (isset($data['color'])) $conditions['color'] = $data['color'];
		if (isset($data['size'])) $conditions['size'] = $data['size'];

		$existingCart = CartRepository::findWhere(array_keys($conditions), array_values($conditions));

		if (!empty($existingCart)) {
			$existingCart = $existingCart[0];
			$existingCart->quantity += $data['quantity'] ?? 1;
			$existingCart->updated_at = date('Y-m-d H:i:s');
			CartRepository::update($existingCart);
			return $this->sendResponse($existingCart);
		} else {
			$data['price'] = $product->price;
			$data['quantity'] = $data['quantity'] ?? 1;
			$data['user_id'] = $userId;
			$data['session_id'] = $sessionId;
			$data['color'] = $data['color'] ?? null;
			$data['size'] = $data['size'] ?? null;
			$data['image'] = $data['image'] ?? null;
			error_log("CartController::store - Saving cart with color: " . ($data['color'] ?? 'null'));
			error_log("CartController::store - About to save cart with image: " . ($data['image'] ?? 'null'));
			$cart = Resource::loadEntity($data, Cart::class);
			CartRepository::save($cart);
			return $this->sendResponse($cart);
		}
	}


	public function update($id) {
		$data = json_decode(file_get_contents("php://input"), true);
		$cart = CartRepository::findOrFail($id);

		if (!$cart) {
			return $this->sendError("Cart item not found", [], 404);
		}

		// Utiliser SessionManager pour valider l'appartenance du panier
		require_once __DIR__ . '/../../../../includes/SessionManager.class.php';
		$sessionManager = SessionManager::getInstance();

		$currentUserId = $sessionManager->getUserId();
		$currentSessionId = $sessionManager->getGuestSession();

		// Vérifier que le panier appartient bien à l'utilisateur/session actuel
		if (($currentUserId && $cart->user_id != $currentUserId) || ($currentSessionId && $cart->session_id != $currentSessionId)) {
			return $this->sendError("Unauthorized", [], 403);
		}

		// Valider quantité
		if (isset($data['quantity']) && $data['quantity'] < 1) {
			return $this->sendError("Quantity must be at least 1", [], 400);
		}

		// Mettre à jour les champs
		if (isset($data['quantity'])) $cart->quantity = $data['quantity'];
		if (isset($data['color'])) $cart->color = $data['color'];
		if (isset($data['size'])) $cart->size = $data['size'];
		$cart->updated_at = date('Y-m-d H:i:s');

		CartRepository::update($cart);
		return $this->sendResponse($cart);
	}


	public function delete($id) {
		$data = json_decode(file_get_contents("php://input"), true);
		$cart = CartRepository::find($id);

		if (!$cart) {
			return $this->sendError("Cart item not found", [], 404);
		}

		// Utiliser SessionManager pour valider l'appartenance du panier
		require_once __DIR__ . '/../../../../includes/SessionManager.class.php';
		$sessionManager = SessionManager::getInstance();

		$currentUserId = $sessionManager->getUserId();
		$currentSessionId = $sessionManager->getGuestSession();

		// Vérifier que le panier appartient bien à l'utilisateur/session actuel
		if (($currentUserId && $cart->user_id != $currentUserId) || ($currentSessionId && $cart->session_id != $currentSessionId)) {
			return $this->sendError("Unauthorized", [], 403);
		}

		CartRepository::delete($cart);
		return $this->sendResponse(null, "Cart item deleted");
	}

}

?>