<?php

namespace Routing;

use Gravity\Core\Routing\ResourceRoutes;
use Gravity\Core\Routing\Route;
use App\Controllers\ContactController;


class ContactRoutes extends ResourceRoutes {

	public function __construct() {

		$this->get = [
			new Route('/contacts', [ContactController::class, 'index']),
			new Route('/contacts/:id', [ContactController::class, 'search']),
		];

		$this->post = [
			new Route('/contacts', [ContactController::class, 'store']),
		];

		$this->put = [
			new Route('/contacts/:id', [ContactController::class, 'update']),
		];

		$this->patch = [
		];

		$this->delete = [
			new Route('/contacts/:id', [ContactController::class, 'delete']),
		];
	
	}

}

?>