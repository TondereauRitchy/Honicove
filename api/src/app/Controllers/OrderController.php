<?php

namespace App\Controllers;

use App\Services\StripePayment;

class OrderController extends BaseController {


	public function index() {}


	public function search($id) {}


	public function store() {
		$data = json_decode(file_get_contents("php://input"), true);
		error_log("OrderController::store - Received data: " . json_encode($data));

		$userId = $data['user_id'] ?? null;
		$sessionId = $data['session_id'] ?? null;

		if (!$userId) {
			return $this->sendError("Vous devez être connecté pour finaliser l'achat", [], 401);
		}

		// Récupérer les articles du panier
		$cartItems = \App\Repository\CartRepository::findOrWhere(['user_id', 'session_id'], [$userId, $sessionId]);

		if (empty($cartItems)) {
			return $this->sendError("Cart is empty", [], 400);
		}

		// Calculer le total
		$total = 0;
		foreach ($cartItems as $item) {
			$total += $item->price * $item->quantity;
		}

		// Créer la commande
		$orderData = [
			'user_id' => $userId,
			'session_id' => $sessionId,
			'total' => $total,
			'status' => 'pending',
			'shipping_address' => json_encode([
				'firstName' => $data['firstName'],
				'lastName' => $data['lastName'],
				'email' => $data['email'],
				'phone' => $data['phone'],
				'address' => $data['address'],
				'address2' => $data['address2'],
				'city' => $data['city'],
				'zip' => $data['zip'],
				'country' => $data['country'],
				'state' => $data['state']
			]),
			'created_at' => date('Y-m-d H:i:s')
		];

		$order = \App\Resources\Resource::loadEntity($orderData, \App\Entity\Order::class);
		$orderId = \App\Repository\OrderRepository::save($order);
		$order->setId($orderId);

		// Créer les items de commande
		foreach ($cartItems as $cartItem) {
			$orderItemData = [
				'order_id' => $orderId,
				'product_id' => $cartItem->product_id,
				'quantity' => $cartItem->quantity,
				'price' => $cartItem->price,
				'color' => $cartItem->color,
				'size' => $cartItem->size
			];
			$orderItem = \App\Resources\Resource::loadEntity($orderItemData, \App\Entity\Order_item::class);
			\App\Repository\Order_itemRepository::save($orderItem);
		}

		// Intégrer Stripe pour le paiement
		
		$stripePayment = new StripePayment('sk_test_51SLokyF8mYQGGK7EVohGhf7DuSsUzE6kC9TAbo5re5jyv8o1V9pu0GjLFRBVP9995H2KmwELfuIHb6oI5XaVgxdj00pezuUtFe');
		$paymentIntent = $stripePayment->startPayment($total,1); // Montant en cents

		if (!$paymentIntent) {
			return $this->sendError("Payment processing failed", [], 500);
		}

		// Mettre à jour la commande avec l'ID de paiement
		$order->payment_intent_id = $paymentIntent->id;
		\App\Repository\OrderRepository::update($order);

		// Vider le panier après succès
		foreach ($cartItems as $cartItem) {
			\App\Repository\CartRepository::delete($cartItem);
		}

		return $this->sendResponse(['order_id' => $orderId, 'payment_intent' => $paymentIntent]);
	}


	public function update($id) {}


	public function delete($id) {}

}

?>