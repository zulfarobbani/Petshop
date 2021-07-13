<?php
namespace App\Transaksi\Model;

use Core\GlobalFunc;
use PDOException;

class Transaksi extends GlobalFunc
{
    private $table = 'transaksi';
    public $conn;

    public function __construct()
    {
        $globalFunc = new GlobalFunc();
        $this->conn = $globalFunc->conn;
    }

    public function selectAll()
    {
        $sql = "SELECT * FROM ". $this->table;

        try{
            $query = $this->conn->prepare($sql);
            $create = $query->execute();

            $data = $query->fetchAll();

            return $data;
        } catch(PDOException $e){
            echo $e;
            die();
        }
    }

    public function selectOne($idTransaksi)
    {
        $sql = "SELECT * FROM ". $this->table. " WHERE idTransaksi = '$idTransaksi'";

        try{
            $query = $this->conn->prepare($sql);
            $create = $query->execute();

            $data = $query->fetch();

            return $data;
        } catch(PDOException $e){
            echo $e;
            die();
        }
    }

    public function selectGroupItem($idGroupItem)
    {
        $sql = "SELECT * FROM groupItem WHERE idGroupItem = '$idGroupItem'";

        try{
            $query = $this->conn->prepare($sql);
            $create = $query->execute();

            $data = $query->fetchAll();

            return $data;
        } catch(PDOException $e){
            echo $e;
            die();
        }
    }

    public function create($data)
    {
        $idTransaksi = $data['idTransaksi'];
        $nomorTransaksi = $data['nomorTransaksi'];
        $kasirTransaksi = $data['kasirTransaksi'];
        $pelangganTransaksi = $data['pelangganTransaksi'];
        $tanggalTransaksi = $data['tanggalTransaksi'];
        $idGroupitem = $data['idGroupitem'];
        $idClient = $data['idClient'];
        $dateCreate = $data['dateCreate'];

        $sql = "INSERT INTO ".$this->table. " VALUES('$idTransaksi', '$nomorTransaksi', '$kasirTransaksi', '$pelangganTransaksi', '$tanggalTransaksi', '$idGroupitem', '$idClient', '$dateCreate')";

        try{
            $query = $this->conn->prepare($sql);
            $create = $query->execute();

            return $create;
        } catch(PDOException $e){
            echo $e;
            die();
        }
    }

    public function createGroupItem($idGroupitem, $idItem, $pengurangItem, $kuantitiItem, $dateCreate)
    {
        $sql = "INSERT INTO groupitem VALUES('$idGroupitem', '$idItem', '$pengurangItem', '$kuantitiItem', '$dateCreate')";

        try{
            $query = $this->conn->prepare($sql);
            $create = $query->execute();

            return $create;
        } catch(PDOException $e){
            echo $e;
            die();
        }
    }

    public function update($idTransaksi ,$data)
    {
        $nomorTransaksi = $data['nomorTransaksi'];
        $kasirTransaksi = $data['kasirTransaksi'];
        $pelangganTransaksi = $data['pelangganTransaksi'];
        $tanggalTransaksi = $data['tanggalTransaksi'];
        // $idGroupitem = $data['idGroupitem'];
        $idClient = $data['idClient'];

        $sql = "UPDATE ".$this->table. " SET nomorTransaksi = '$nomorTransaksi', kasirTransaksi = '$kasirTransaksi', pelangganTransaksi = '$pelangganTransaksi', tanggalTransaksi = '$tanggalTransaksi', idClient = '$idClient' WHERE idTransaksi = '$idTransaksi'";

        try{
            $query = $this->conn->prepare($sql);
            $create = $query->execute();

            return $create;
        } catch(PDOException $e){
            echo $e;
            die();
        }
    }

    public function deleteGroupItem($idGroupitem)
    {
        $sql = "DELETE FROM groupitem WHERE idGroupitem = '$idGroupitem'";

        try{
            $query = $this->conn->prepare($sql);
            $delete = $query->execute();

            return $delete;
        } catch(PDOException $e){
            echo $e;
            die();
        }
    }
    
}

?>