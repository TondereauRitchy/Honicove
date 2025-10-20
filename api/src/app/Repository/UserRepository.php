<?php

namespace App\Repository;

use App\Entity\User;

class UserRepository extends Repository
{
    protected static $entity = User::class;
	protected static $table = 'users';
}
?>