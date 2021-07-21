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

    public function countRows()
    {
        $sql = "SELECT COUNT(".$this->primaryKey.") as count FROM " . $this->table;

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

    public function selectAll($where = "")
    {
        $sql = "SELECT * FROM ".$this->table. " ".$where;

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

    public function create($datas)
    {
        $idUsers = $datas['idUsers'];
        $namaUser = $datas['namaUser'];
        $passwordUser = $datas['passwordUser'];
        $hirarkiUser = $datas['hirarkiUser'];
        $dateCreate = $datas['dateCreate'];
        $emailUser = $datas['emailUser'];
        $nohpUser = $datas['nohpUser'];

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

    public function update($id_user, $datas)
    {
        $namaUser = $datas['namaUser'];
        $hirarkiUser = $datas['hirarkiUser'];
        $emailUser = $datas['emailUser'];
        $nohpUser = $datas['nohpUser'];

        $sql = "UPDATE ".$this->table. " SET namaUser = '$namaUser', hirarkiUser = '$hirarkiUser', emailUser = '$emailUser', nohpUser = '$nohpUser' WHERE ".$this->primaryKey." = '$id_user'";

        try {
            $query = $this->conn->prepare($sql);

            $query->execute();

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

    public function chronologyMessage($action, $user, $object)
    {
        $message = [
            'store' => $user." telah menambah user \"".$object['user']."\"",
            'update' => $user." telah mengubah user \"".$object['user']."\"",
            'delete' => $user." telah menghapus user \"".$object['user']."\"",
            // 'retur' => $user." telah melakukan retur user \"".$object['user']."\" dengan kuantitas ".$object['retur']." ".$object['satuan'],
        ];

        return $message[$action];
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
