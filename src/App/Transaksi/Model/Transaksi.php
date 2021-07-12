<?php
namespace App\Transaksi\Model;

use Core\GlobalFunc;
use PDOException;

class Transaksi extends GlobalFunc
{
    private $table = 'transaksi';
    public $conn;

    public function __construct()
    {
        $globalFunc = new GlobalFunc();
        $this->conn = $globalFunc->conn;
    }
}

?>