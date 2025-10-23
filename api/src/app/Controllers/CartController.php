<?php

namespace App\Controllers;

use App\Entity\Cart;
use App\Repository\CartRepository;
use App\Resources\Resource;

class CartController extends BaseController {


	public function index() {
		$userId = $_GET['user_id'] ?? null;
		$sessionId = $_GET['session_id'] ?? null;

		if (!$userId && !$sessionId) {
			return $this->sendError("User ID or Session ID is required", [], 400);
		}

		$conditionColumns = [];
		$params = [];
		if ($userId) {
			$conditionColumns[] = 'user_id';
			$params[] = (int)$userId; // Traiter user_id comme entier
		}
		if ($sessionId) {
			$conditionColumns[] = 'session_id';
			$params[] = (string)$sessionId; // Traiter session_id comme chaîne
		}

		error_log("CartController::index - userId: $userId, sessionId: $sessionId");
		error_log("CartController::index - conditionColumns: " . implode(',', $conditionColumns));
		error_log("CartController::index - params: " . implode(',', $params));

		$carts = CartRepository::findOrWhere($conditionColumns, $params);

		error_log("CartController::index - carts found: " . count($carts));

		// Enrichir avec les détails des produits
		$enrichedCarts = [];
		foreach ($carts as $cart) {
			$product = \App\Repository\ProductRepository::find($cart->product_id);
			if ($product) {
				$cart->product_name = $product->name;
				$cart->product_price = $product->price;
				// Utiliser la même logique que dans produit.php : récupérer depuis product_images si disponible, sinon image_1
				$images = \App\Repository\ProductImageRepository::findWhere(['product_id'], [$product->id]);
				if (!empty($images)) {
					$cart->product_image = $images[0]->image_path;
				} else {
					$cart->product_image = $product->image_1;
				}
			}
			$enrichedCarts[] = $cart;
		}

		error_log("CartController::index - enriched carts: " . count($enrichedCarts));

		return $this->sendResponse($enrichedCarts);
	}


	public function search($id) {
		$data = json_decode(file_get_contents("php://input"), true);
		$cart = CartRepository::findOrFail($id);
		return $this->sendResponse($cart);
	}


	public function store() {
		$data = json_decode(file_get_contents("php://input"), true);
		error_log("CartController::store - Received data: " . json_encode($data));
		$userId = $data['user_id'] ?? null;
		$sessionId = $data['session_id'] ?? null;

		if (!$userId && !$sessionId) {
			return $this->sendError("User ID or Session ID is required", [], 400);
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

		// Vérifications de propriété (user_id ou session_id)
		$userId = $data['user_id'] ?? null;
		$sessionId = $data['session_id'] ?? null;
		if ($userId) $userId = (int)$userId; // user_id comme entier
		if ($sessionId) $sessionId = (string)$sessionId; // session_id comme chaîne
		if (($userId && $cart->user_id != $userId) || ($sessionId && $cart->session_id != $sessionId)) {
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
		$cart = CartRepository::findOrFail($id);

		if (!$cart) {
			return $this->sendError("Cart item not found", [], 404);
		}

		// Vérifications de propriété
		$userId = $data['user_id'] ?? null;
		$sessionId = $data['session_id'] ?? null;
		if ($userId) $userId = (int)$userId; // user_id comme entier
		if ($sessionId) $sessionId = (string)$sessionId; // session_id comme chaîne
		if (($userId && $cart->user_id != $userId) || ($sessionId && $cart->session_id != $sessionId)) {
			return $this->sendError("Unauthorized", [], 403);
		}

		CartRepository::delete($id);
		return $this->sendResponse(null, "Cart item deleted");
	}

}

?>