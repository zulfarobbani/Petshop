<?php

namespace Config;

use PDO;
use PDOException;

class Database{
 
	var $host = "localhost";
	var $username = "postgres";
	var $pass = "oaxudowh9";
	var $db = "bpnb";
    var $driver = 'pgsql';
    var $port = '5432';
    var $conn;
 
	function __construct(){
        try {
            $this->conn = new PDO($this->driver.":host={$this->host};port={$this->port};dbname={$this->db};", $this->username, $this->pass);
        } catch (PDOException $th) {
            echo "Tidak dapat terkoneksi dengan database";
            echo $th;
            die();
        }
	}
 
} 

?>