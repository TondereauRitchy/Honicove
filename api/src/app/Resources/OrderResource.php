<?php

namespace App\Resources;

use App\Entity\Order;


class OrderResource extends Resource {

	protected $entity = Order::class;


	function toArray() {
		$data = $this->entity->toArray();

		return $data;
	}

}

?>