<?php

namespace App\Chronology\Model;

use Core\GlobalFunc;
use PDOException;

class Chronology extends GlobalFunc
{
    private $table = 'chronology';
    public $conn;

    public function __construct()
    {
        $globalFunc = new GlobalFunc();
        $this->conn = $globalFunc->conn;
    }    
    
    public function selectAll()
    {
        $sql = "SELECT * FROM " . $this->table;

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
        $sql = "SELECT * FROM " . $this->table . " WHERE idChronology = '$id'";

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

    public function create($deskripsiChronology, $idTables)
    {
        $idChronology = uniqid('crn');
        $dateCreate = date('Y-m-d');

        $sql = "INSERT INTO ".$this->table." VALUES ('$idChronology', '$deskripsiChronology', '$idTables', '$dateCreate')";

        try {
            $data = $this->conn->prepare($sql);
            $data->execute();

            return $idChronology;
        } catch (PDOException $e) {
            echo $e;
            die();
        }
    }

    public function update($idChronology, $deskripsiChronology)
    {
        $sql = "UPDATE ".$this->table." SET deskripsiChronology = '$deskripsiChronology' WHERE idChronology = '$idChronology'";
        
        try {
            $data = $this->conn->prepare($sql);
            $data->execute();

            return $idChronology;
        } catch (PDOexception $e) {
            echo $e;
            die();
        }
    }

    public function delete($idChronology)
    {
        $sql = "DELETE FROM ".$this->table." WHERE idChronology = '$idChronology'";
        
        try {
            $query = $this->conn->prepare($sql);
            $query->execute();

            return $query;
        } catch (PDOException $e) {
            dump($e);
            die();
        }
    }
}