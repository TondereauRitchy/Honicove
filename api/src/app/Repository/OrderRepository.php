<?php

namespace App\Repository;

use App\Entity\Order;

class OrderRepository extends Repository
{
    protected static $entity = Order::class;
	protected static $table = 'orders';
}
?>