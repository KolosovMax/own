<?php

namespace Disk\Kernel;

use PDO;

class DbConnection
{
    private static $instance;
    private $connection;

    private function __construct($settings = 'db.php')
    {
        $data = require_once '../settings/' . $settings;
        $server = $data['server'];
        $port = $data['port'];
        $username = $data['username'];
        $pwd = $data['pwd'];
        $db_name = $data['db_name'];
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        $this->connection = new PDO("mysql:host=$server;port=$port;dbname=$db_name", $username, $pwd, $options);
    }

    private function __clone()
    {
    }

    public static function getInstance($settings = 'db.php'): DbConnection
    {
        if (self::$instance == null) self::$instance = new DbConnection($settings);
        return self::$instance;
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }
}