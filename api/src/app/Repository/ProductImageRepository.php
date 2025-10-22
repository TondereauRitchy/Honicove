<?php

namespace App\Repository;

use App\Entity\ProductImage;

class ProductImageRepository extends Repository
{
    protected static $entity = ProductImage::class;
	protected static $table = 'product_images';
}
?>
