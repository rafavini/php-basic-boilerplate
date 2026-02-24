<?php

namespace Core;

use Core\Database;

abstract class Model
{
    /**
     * @var \PDO
     */
    protected static $db = null;

    /**
     * Initialize the database connection once per model
     */
    protected static function getDB()
    {
        if (self::$db === null) {
            self::$db = Database::getInstance();
        }
        return self::$db;
    }
}
