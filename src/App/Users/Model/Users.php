<?php

namespace App\Users\Model;

use Core\GlobalFunc;
use PDOException;

class Users extends GlobalFunc
{
    private $table = 'users';
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

    public function selectOne($id_user)
    {
        $sql = "SELECT * FROM ".$this->table." WHERE idUser = '$id_user'";

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

    public function create($data)
    {

        $idUsers = $data['idUsers'];
        $namaUsers = $data['namaUsers'];
        $passwordUser = $data['passwordUser'];
        $nikUser = $data['nikUser'];
        $hirarkiUser = $data['hirarkiUser'];
        $dateCreate = $data['dateCreate'];

        $sql = "INSERT INTO ". $this->table ." VALUES('$idUsers', '$namaUsers', '$passwordUser', '$hirarkiUser', '$nikUser', '$dateCreate')";

        try {
            $query = $this->conn->prepare($sql);

            $status = $query->execute();

            return $status;
        } catch (PDOException $e) {
            echo $e;
            die();
        }
    }

    public function update($id_user, $data)
    {
        $namaUsers = $data['namaUsers'];
        $passwordUser = $data['passwordUser'];
        $nikUser = $data['nikUser'];
        $hirarkiUser = $data['hirarkiUser'];

        $sql = "UPDATE ".$this->table. " SET namaUser = '$namaUsers', passwordUser = '$passwordUser', nikUser = '$nikUser', hirarkiUser = '$hirarkiUser'";

        try {
            $query = $this->conn->prepare($sql);

            $status = $query->execute();

            return $status;
        } catch (PDOException $e) {
            echo $e;
            die();
        }
    }

    public function delete($id_user)
    {
        $sql = "DELETE FROM ". $this->table. " WHERE idUser = '$id_user'";

        try {
            $query = $this->conn->prepare($sql);

            $status = $query->execute();

            return $status;
        } catch (PDOException $e) {
            echo $e;
            die();
        }
    }
}
