<?php

namespace App\Resources;

use App\Entity\Product;


class ProductResource extends Resource {

	protected $entity = Product::class;


	function toArray() {
		$data = $this->entity->toArray();

		return $data;
	}

}

?>