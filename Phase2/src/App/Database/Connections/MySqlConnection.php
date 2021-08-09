<?php

namespace Rodri\Phase2\App\Database\Connections;

use PDO;

/**
 * Mysql Connection
 * @author Rodrigo Andrade
 */
class MySqlConnection extends Connection
{
    public static function getConnection(): Connection
    {
        if (empty(self::$instance))
            self::$instance = new MySqlConnection();

        return self::$instance;
    }

    public function pdo(): PDO
    {
        if (!self::getConnection()->pdoInstance) {

            !self::getConnection()->pdoInstance = new PDO(
                getenv('DB_DNS'),
                getenv('DB_USER_NAME'),
                getenv('DB_USER_PASS'),
                self::OPTIONS,
            );
        }

        return self::getConnection()->pdoInstance;
    }
}