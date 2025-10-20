<?php

namespace App\Repository;

use App\Entity\Contact;

class ContactRepository extends Repository
{
    protected static $entity = Contact::class;
	protected static $table = 'contacts';
}
?>