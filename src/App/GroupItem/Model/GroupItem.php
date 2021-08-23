<?php

namespace App\GroupItem\Model;

use Core\GlobalFunc;
use PDOException;

class GroupItem extends GlobalFunc
{
    private $table = 'groupitem';
    public $conn;

    public function __construct()
    {
        $globalFunc = new GlobalFunc();
        $this->conn = $globalFunc->conn;
    }    
    
    public function selectAll($where = "")
    {
        $sql = "SELECT *, ".$this->table.".hargaItem as hargaItemGroup, ".$this->table.".satuanItem as satuanItemGroup, ".$this->table.".kuantitiItem as groupkuantitiItem FROM " . $this->table . " LEFT JOIN item ON ".$this->table.".idItem = item.idItem LEFT JOIN hargaitem ON hargaitem.idHargaitem = ".$this->table.".idHargaitem " . $where;
        
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
        $sql = "SELECT * FROM " . $this->table . " WHERE idGroupitem = '$id'";

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

    public function delete($id)
    {
        $sql = "DELETE FROM " . $this->table . " WHERE idTransaksi = '$id'";

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
}