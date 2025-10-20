<?php

namespace App\Controllers;

use App\Entity\Cart;
use App\Repository\CartRepository;
use App\Resources\Resource;

class CartController extends BaseController {


	public function index() {}


	public function search($id) {
		$data = json_decode(file_get_contents("php://input"), true);
		$cart = CartRepository::findOrFail($id);
		return $this->sendResponse($cart);
	}


	public function store() {
		$data = json_decode(file_get_contents("php://input"), true);
		$userId = $data['user_id'] ?? null;
		$existingCart = CartRepository::findWhere(['product_id','user_id'], [$data['product_id'], $userId]);

        if(!empty($existingCart)){
			$existingCart = $existingCart[0];
			$existingCart->quantity += $data['quantity'];
			CartRepository::update($existingCart);
			return $this->sendResponse($existingCart);
		} else {

			$cart = Resource::loadEntity($data, Cart::class);
			CartRepository::save($cart);
			return $this->sendResponse($cart);
		}
	}


	public function update($id) {}


	public function delete($id) {}

}

?>