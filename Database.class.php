<?php

class Database
{
    public $conn;
    private $host;
    private $user;
    private $password;
    private $baseName;
    private $port;
    private $Debug;

    public function __construct($params=array()) {
        $this->conn = false;
        $this->host = 'localhost'; //hostname
       
        $this->user = 'root'; //username
        $this->password = ''; //password
        $this->baseName = 'db'; //name of your database
        $this->port = '3306';
        $this->Debug = true;
        $this->connect();
    }

    public function __destruct() {
        $this->disconnect();
    }

    public function connect() {
        if (!$this->conn) {
            try {
                $this->conn = new PDO('mysql:host='.$this->host.';dbname='.$this->baseName.'', $this->user, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
                // set the PDO error mode to exception
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }

            if (!$this->conn) {
                $this->status_fatal = true;
                echo 'Connection BDD failed';
                die();
            }
            else {
                $this->status_fatal = false;
            }
        }

        return $this->conn;
    }

    public function disconnect() {
        if ($this->conn) {
            $this->conn = null;
        }
    }

}
