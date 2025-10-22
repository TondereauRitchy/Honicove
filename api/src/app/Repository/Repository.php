<?php

namespace App\Repository;


use Gravity\Core\App\Repository\Repository as BaseRepository;


abstract class Repository extends BaseRepository {

    public static function getLastInsertedId() {
        $last = static::rawQuery("SELECT MAX(id) AS id FROM " . static::$table);

        if (!empty($last)) {
            return $last[0]['id'];
        }

        return null;
    }
    
}


?>
