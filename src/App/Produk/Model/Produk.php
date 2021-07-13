<?php

namespace App\Produk\Model;

use Core\GlobalFunc;
use PDOException;

class Produk extends GlobalFunc
{
    private $table = 'item';
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
    
    public function create($data_test = [])
    {
         $idItem = uniqid('itm');
         $namaItem = $data_test['namaItem'];
         $kuantiti = $data_test['kuantiti'];
         $harga = $data_test['harga'];
         $dateCreate = $data_test['dateCreate'];
         $produkMasuk = $data_test['produkMasuk'];
         $produkExpire = $data_test['produkExpire'];
         
        $sql = "INSERT INTO ".$this->table." VALUES ('$idItem','$namaItem', '', '$harga', '$kuantiti', '$dateCreate', '$produkMasuk', '$produkExpire')";

        try {
            $data = $this->conn->prepare($sql);

            $data->execute();
            return $data->rowCount();
        } catch (PDOException $e) {
            echo $e;
            die();
        }
    }
    public function selectOne($id)
    {
        $sql = "SELECT * FROM ".$this->table." WHERE idItem = '$id'";

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
    public function update($id, $data_test = [])
    {
        $namaItem = $data_test['namaItem'];
         $kuantiti = $data_test['kuantiti'];
         $harga = $data_test['harga'];
         $produkMasuk = $data_test['produkMasuk'];
         $produkExpire = $data_test['produkExpire'];

        $sql = "UPDATE ".$this->table." SET namaItem = '$namaItem', kuantitiItem = '$kuantiti', hargaItem = '$harga', tanggalmasukProduk = '$produkMasuk', tanggalexpireProduk = '$produkExpire' WHERE idItem='$id'";

        try{
            $data = $this->conn->prepare($sql);
            $data->execute();  
        }catch (PDOexception $e){
            echo $e;
            die();
        }
    }

    public function delete($id)
    {
        $sql = "DELETE FROM ".$this->table." WHERE idItem = '$id'";

        try{
            $query = $this->conn->prepare($sql);
            $query->execute();
            return $query;
           
        }catch(PDOException $e) {
            dump($e);
            die();
        }
    }
}