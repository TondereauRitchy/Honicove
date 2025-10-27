<?php

namespace Routing;

use Gravity\Core\Routing\ResourceRoutes;
use Gravity\Core\Routing\Route;
use App\Controllers\OrderController;


class OrderRoutes extends ResourceRoutes {

	public function __construct() {

		$this->get = [
			new Route('/orders', [OrderController::class, 'index']),
			new Route('/orders/:id', [OrderController::class, 'search']),
		];

		$this->post = [
			new Route('/orders', [OrderController::class, 'store']),
		];

		$this->put = [
			new Route('/orders/:id', [OrderController::class, 'update']),
		];

		$this->patch = [
		];

		$this->delete = [
			new Route('/orders/:id', [OrderController::class, 'delete']),
		];
	
	}

}

?>