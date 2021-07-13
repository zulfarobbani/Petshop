<?php

namespace App\Login\Model;

use Core\GlobalFunc;
use PDO;
use PDOException;
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

}

?>