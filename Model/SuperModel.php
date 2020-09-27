<?php

namespace App\Model;

use PDO;

class SuperModel
{
    protected $mypdo;

    public function __construct()
    {
        $pdoOptions = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING,
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        ];

        /**
         * @var $host
         * @var $dbname
         * @var $user
         * @var $password
         */
        include '../config/bdd_config.php';

        $this->mypdo = new PDO("mysql:host=$host;dbname=$dbname", "$user", "$password", $pdoOptions);
    }
}
