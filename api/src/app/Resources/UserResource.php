<?php

namespace App\Resources;

use App\Entity\User;


class UserResource extends Resource {

	protected $entity = User::class;


	function toArray() {
		$data = $this->entity->toArray();

		return $data;
	}

}

?>