<?php

namespace App\Repository;

use App\Entity\Category;

class CategoryRepository extends Repository
{
    protected static $entity = Category::class;
	protected static $table = 'categories';
}
?>