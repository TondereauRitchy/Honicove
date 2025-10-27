<?php

namespace Routing;

use Gravity\Core\Routing\ResourceRoutes;
use Gravity\Core\Routing\Route;
use App\Controllers\UserController;


class UserRoutes extends ResourceRoutes {

	public function __construct() {

		$this->get = [
			new Route('/users', [UserController::class, 'index']),
			new Route('/users/:id', [UserController::class, 'search']),
		];

		$this->post = [
			new Route('/users', [UserController::class, 'store']),
			new Route('/users/login', [UserController::class, 'login']),
			new Route('/users/customer-login', [UserController::class, 'customerLogin']),
		];

		$this->put = [
			new Route('/users/:id', [UserController::class, 'update']),
		];

		$this->patch = [
		];

		$this->delete = [
			new Route('/users/:id', [UserController::class, 'delete']),
		];
	
	}

}

?>