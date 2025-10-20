<?php

namespace App\Repository;

use App\Entity\Product;

class ProductRepository extends Repository
{
    protected static $entity = Product::class;
	protected static $table = 'products';
}
?>