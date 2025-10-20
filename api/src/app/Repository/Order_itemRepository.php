<?php

namespace App\Repository;

use App\Entity\Order_item;

class Order_itemRepository extends Repository
{
    protected static $entity = Order_item::class;
	protected static $table = 'order_items';
}
?>