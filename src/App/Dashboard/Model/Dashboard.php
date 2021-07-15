<?php

namespace App\Dashboard\Model;

use Core\GlobalFunc;
use PDOException;

class Dashboard extends GlobalFunc
{
    public $conn;

    public function __construct()
    {
        $globalFunc = new GlobalFunc();
        $this->conn = $globalFunc->conn;
    }

}
