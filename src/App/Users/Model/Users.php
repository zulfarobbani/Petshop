<?php

namespace App\Users\Model;

use Core\GlobalFunc;
use PDOException;

class Users extends GlobalFunc
{
    private $table = 'users';
    private $primaryKey = 'idUser';
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
        $sql = "SELECT * FROM ".$this->table." LEFT JOIN media ON media.idRelation = ".$this->table.".".$this->primaryKey." WHERE ".$this->primaryKey." = '$id_user'";

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
        $namaUser = $data['namaUser'];
        $passwordUser = $data['passwordUser'];
        $hirarkiUser = $data['hirarkiUser'];
        $dateCreate = $data['dateCreate'];
        $emailUser = $data['emailUser'];
        $nohpUser = $data['nohpUser'];

        $sql = "INSERT INTO ". $this->table ." VALUES('$idUsers', '$emailUser', '$namaUser', '$nohpUser', '$passwordUser', '$hirarkiUser', '$dateCreate')";

        try {
            $query = $this->conn->prepare($sql);
            $status = $query->execute();

            return $idUsers;
        } catch (PDOException $e) {
            echo $e;
            die();
        }
    }

    public function update($id_user, $data)
    {
        $namaUser = $data['namaUser'];
        $hirarkiUser = $data['hirarkiUser'];
        $emailUser = $data['emailUser'];
        $nohpUser = $data['nohpUser'];

        $sql = "UPDATE ".$this->table. " SET namaUser = '$namaUser', hirarkiUser = '$hirarkiUser', emailUser = '$emailUser', nohpUser = '$nohpUser' WHERE ".$this->primaryKey." = '$id_user'";

        try {
            $query = $this->conn->prepare($sql);

            $status = $query->execute();

            return $id_user;
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

    public function resetPassword($id_user)
    {
        $passwordUser = password_hash('123', PASSWORD_DEFAULT);
        $sql = "UPDATE ".$this->table. " SET passwordUser = '$passwordUser' WHERE ".$this->primaryKey." = '$id_user'";

        try {
            $query = $this->conn->prepare($sql);
            $status = $query->execute();

            return $id_user;
        } catch (PDOException $e) {
            echo $e;
            die();
        }
    }

    public function updatePassword($id_user, $passwordBaru)
    {
        $passwordUser = password_hash($passwordBaru, PASSWORD_DEFAULT);
        $sql = "UPDATE ".$this->table. " SET passwordUser = '$passwordUser' WHERE ".$this->primaryKey." = '$id_user'";

        try {
            $query = $this->conn->prepare($sql);
            $status = $query->execute();

            return $id_user;
        } catch (PDOException $e) {
            echo $e;
            die();
        }
    }
}
