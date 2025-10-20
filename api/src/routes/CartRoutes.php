<?php

namespace Routing;

use Gravity\Core\Routing\ResourceRoutes;
use Gravity\Core\Routing\Route;
use App\Controllers\CartController;


class CartRoutes extends ResourceRoutes {

	public function __construct() {

		$this->get = [
			new Route('/carts', [CartController::class, 'index']),
			new Route('/carts/:id', [CartController::class, 'search']),
		];

		$this->post = [
			new Route('/carts', [CartController::class, 'store']),
		];

		$this->put = [
			new Route('/carts/:id', [CartController::class, 'updae']),
		];

		$this->patch = [
		];

		$this->delete = [
			new Route('/carts/:id', [CartController::class, 'delete']),
		];
	
	}

}

?>