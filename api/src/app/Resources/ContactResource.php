<?php

namespace App\Resources;

use App\Entity\Contact;


class ContactResource extends Resource {

	protected $entity = Contact::class;


	function toArray() {
		$data = $this->entity->toArray();

		return $data;
	}

}

?>