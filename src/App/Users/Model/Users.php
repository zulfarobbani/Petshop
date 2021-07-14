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

    public function create($datas)
    {

        $idUser = uniqid('user');
        $namaUser = $datas->get('namaUser');
        $passwordUser = password_hash($datas->get('passwordUser'), PASSWORD_DEFAULT);
        $hirarkiUser = $datas->get('hirarkiUser');
        $nikUser = $datas->get('nikUser');
        $dateCreate = date("Y-m-d");
        $emailUser = $datas->get('emailUser');

        $sql = "INSERT INTO ". $this->table ." VALUES('$idUser', '$namaUser', '$passwordUser', '$hirarkiUser', '$nikUser', '$dateCreate', '$emailUser')";

        try {
            $query = $this->conn->prepare($sql);

            $query->execute();

            return $idUser;
        } catch (PDOException $e) {
            echo $e;
            die();
        }
    }

    public function update($id_user, $datas)
    {
        $namaUser = $datas->get('namaUser');
        $passwordUser = password_hash($datas->get('passwordUser'), PASSWORD_DEFAULT);
        $hirarkiUser = $datas->get('hirarkiUser');
        $nikUser = $datas->get('nikUser');
        $emailUser = $datas->get('emailUser');

        $sql = "UPDATE ".$this->table. " SET namaUser = '$namaUser', passwordUser = '$passwordUser', nikUser = '$nikUser', hirarkiUser = '$hirarkiUser', emailUser = '$emailUser'";

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
}
