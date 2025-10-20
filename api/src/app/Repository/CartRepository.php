<?php

namespace App\Repository;

use App\Entity\Cart;

class CartRepository extends Repository
{
    protected static $entity = Cart::class;
	protected static $table = 'carts';
}
?>