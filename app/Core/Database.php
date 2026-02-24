<?php

namespace Core;

use PDO;
use PDOException;

class Database
{
    // Armazena diretamente a conexão PDO (mais rápido, menos memória)
    private static $connection = null;

    public static function getInstance()
    {
        if (self::$connection === null) {
            // Carregamos as configs apenas uma vez no momento da conexão
            $config = require __DIR__ . '/../../config/app.php';
            $db = $config['db'];
            
            try {
                $dsn = "mysql:host={$db['host']};dbname={$db['dbname']};charset=utf8mb4";
                
                self::$connection = new PDO($dsn, $db['user'], $db['pass'], [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                    PDO::ATTR_PERSISTENT         => true 
                ]);
            } catch (PDOException $e) {
                error_log($e->getMessage());
                throw new \Exception("Erro ao conectar ao banco de dados.");
            }
        }
        return self::$connection;
    }
}