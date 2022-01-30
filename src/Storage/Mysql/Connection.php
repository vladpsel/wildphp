<?php

declare(strict_types=1);

namespace Voopsc\Wild\Storage\Mysql;

use PDO;

class Connection
{
    private string $host;
    private string $db;
    private string $user;
    private string $password;
    private string $charset;

    public function __construct()
    {
        $this->host = getenv('MYSQL_HOST');;
        $this->db  = getenv('MYSQL_DB');
        $this->user = getenv('MYSQL_USER');
        $this->password = getenv('MYSQL_PASS');
        $this->charset = 'utf8';
    }

    /**
     * Setup connection with mysql storage
     * @return PDO
     */
    public function getConnection(): PDO
    {
        $dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
        $opt = array(
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        );
        return new PDO($dsn, $this->user, $this->password, $opt);
    }
}