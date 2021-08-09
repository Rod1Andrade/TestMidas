<?php

namespace Rodri\Phase2\App\Database\Connections;

use PDO;

/**
 * Interface Connection
 * @author Rodrigo Andrade
 */
abstract class Connection
{
    protected static ?Connection $instance = null;
    protected ?PDO $pdoInstance = null;

    protected const OPTIONS = [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
    ];

    /**
     * Get a connection
     * @return Connection
     */
    public abstract static function getConnection(): Connection;

    /**
     * Get Single Postgres PDO connection.
     * @return PDO
     */
    public abstract function pdo(): PDO;

    /**
     * Private constructor to maintain singleton pattern.
     * @codeCoverageIgnore
     */
    protected function __construct()
    {
    }

    /**
     * Private clone to maintain singleton pattern.
     * @codeCoverageIgnore
     */
    protected function __clone(): void
    {
    }
}