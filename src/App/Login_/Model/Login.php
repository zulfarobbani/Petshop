<?php

namespace App\Login\Model;

use Core\GlobalFunc;
use PDOException;
use Symfony\Component\HttpFoundation\Request;

class Login extends GlobalFunc
{
    private $table = "users";
    public $conn;
    
    public function __construct()
    {
        $globalFunc = new GlobalFunc();
        $this->conn = $globalFunc->conn;
    }

    public function selectOne($emailUser)
    {
        $sql = "SELECT * FROM ". $this->table ." WHERE emailUser = :emailUser";

        try{
            $query = $this->conn->prepare($sql);
            $query->bindParam(':emailUser', $emailUser, PDO::PARAM_STR);

            $query->execute();

            $data = $query->fetch();

            return $data;
        } catch(PDOException $e){
            echo $e;
            die();
        }
    }

    public function getPermission($id)
    {
        $sql = "SELECT * FROM permission WHERE idUser = '$id'";

        try{
            $query = $this->conn->prepare($sql);
            $query->execute();

            $data = $query->fetchAll();

            return $data;
        } catch(PDOException $e){
            echo $e;
            die();
        }
    }
}

?>