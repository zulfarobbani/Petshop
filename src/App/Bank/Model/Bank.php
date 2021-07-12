<?php

namespace App\Bank\Model;

use Core\GlobalFunc;
use PDOException;

class Bank extends GlobalFunc
{
    private $table = 'bank';
    public $conn;

    public function __construct()
    {
        $globalFunc = new GlobalFunc();
        $this->conn = $globalFunc->conn;
    }

    public function selectAll()
    {
        $sql = "SELECT * FROM ".$this->table;

        try {
            $query = $this->conn->prepare($sql);
            $query->execute();
            $data = $query->fetchAll();

            return $data;
        } catch (PDOException $e) {
            echo $e;
            die();
        }
    }

    public function selectOne($id)
    {
        $sql = "SELECT * FROM ".$this->table." WHERE idBank = '$id'";

        try {
            $query = $this->conn->prepare($sql);
            $query->execute();
            $data = $query->fetch();

            return $data;
        } catch (PDOException $e) {
            echo $e;
            die();
        }
    }

    public function create($requestForm)
    {
        // create([
        //     "column" => "idBank, namaBank",
        //     "values" => "'$idBank', '$namaBank'"
        // ]);

        $sql = "INSERT INTO ".$this->table." (".$requestForm['column'].") VALUES (".$requestForm['values'].")";

        try {
            $data = $this->conn->prepare($sql);

            $data->execute();
            return $data->rowCount();
        } catch (PDOException $e) {
            echo $e;
            die();
        }
    }
}
