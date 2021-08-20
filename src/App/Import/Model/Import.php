<?php

namespace App\Import\Model;

use Core\GlobalFunc;
use PDOException;
use Symfony\Component\HttpFoundation\Request;

class Import extends GlobalFunc
{
    private $table = "users";
    public $conn;
    
    public function __construct()
    {
        $globalFunc = new GlobalFunc();
        $this->conn = $globalFunc->conn;
    }
}

?>