<?php

namespace App\Repository;

use App\Entity\Session;

class SessionRepository extends Repository
{
    protected static $entity = Session::class;
	protected static $table = 'sessions';
}
?>
