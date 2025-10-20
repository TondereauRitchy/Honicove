<?php

namespace Routing;

use Gravity\Core\Routing\ResourceRoutes;
use Gravity\Core\Routing\Route;
use App\Controllers\ProductController;


class ProductRoutes extends ResourceRoutes {

	public function __construct() {

		$this->get = [
			new Route('/products', [ProductController::class, 'index']),
			new Route('/products/:id', [ProductController::class, 'search']),
		];

		$this->post = [
			new Route('/products', [ProductController::class, 'store']),
		];

		$this->put = [
			new Route('/products/:id', [ProductController::class, 'updae']),
		];

		$this->patch = [
		];

		$this->delete = [
			new Route('/products/:id', [ProductController::class, 'delete']),
		];
	
	}

}

?>