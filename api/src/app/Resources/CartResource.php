<?php

namespace App\Resources;

use App\Entity\Cart;


class CartResource extends Resource {

	protected $entity = Cart::class;


	function toArray() {
		$data = $this->entity->toArray();

		return $data;
	}

}

?>