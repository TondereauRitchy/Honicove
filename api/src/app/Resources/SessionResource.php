<?php

namespace App\Resources;

use App\Entity\Session;


class SessionResource extends Resource {

	protected $entity = Session::class;


	function toArray() {
		$data = $this->entity->toArray();

		return $data;
	}

}

?>
