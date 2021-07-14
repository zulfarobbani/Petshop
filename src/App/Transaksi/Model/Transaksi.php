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

    public function selectGroupItem($idTransaksi)
    {
        $sql = "SELECT * FROM groupItem WHERE idTransaksi = '$idTransaksi'";

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

    public function create($datas)
    {
        //Data For Creating Transaksi
        $idTransaksi = uniqid('tran');
        $nomorTransaksi = $datas->get('nomorTransaksi');
        $kasirTransaksi = $datas->get('kasirTransaksi');
        $pelangganTransaksi = $datas->get('pelangganTransaksi');
        $tanggalTransaksi = $datas->get('tanggalTransaksi');
        $idClient = $datas->get('idClient');
        $dateCreate = date('Y-m-d');

        //Data For Creating Group Item
        $idItem = $datas->get('idItem');
        $kuantitiItem = $datas->get('kuantitiItem');
        $pengurangItem = $datas->get('pengurangItem');
        
        //SQL Creating Transaksi
        $sql = "INSERT INTO ".$this->table. " VALUES('$idTransaksi', '$nomorTransaksi', '$kasirTransaksi', '$pelangganTransaksi', '$tanggalTransaksi', '', '$idClient', '$dateCreate')";
        
        //SQL Creating Group Item
        $sqlGroupitem = "INSERT INTO groupitem VALUES ";
        
        for ($index = 0; $index < count($idItem); $index++){
            $idGroupitem = uniqid('gi');

            if ($index + 1 != count($idItem)){
                $sqlGroupitem .= "('$idGroupitem', '$idTransaksi', '$idItem[$index]', '$pengurangItem[$index]', '$kuantitiItem[$index]', '$dateCreate'),";
            } else {
                $sqlGroupitem .= "('$idGroupitem', '$idTransaksi', '$idItem[$index]', '$pengurangItem[$index]', '$kuantitiItem[$index]', '$dateCreate');";
            }
        }

        try{
            $query = $this->conn->prepare($sql);
            $queryGroupitem = $this->conn->prepare($sqlGroupitem);

            $query->execute();
            $queryGroupitem->execute();

            return $idTransaksi;
        } catch(PDOException $e){
            echo $e;
            die();
        }
    }

    // public function createGroupItem($idGroupitem, $idTransaksi, $idItem, $pengurangItem, $kuantitiItem, $dateCreate)
    // {
    //     $sql = "INSERT INTO groupitem VALUES('$idGroupitem', '$idTransaksi', '$idItem', '$pengurangItem', '$kuantitiItem', '$dateCreate')";

    //     try{
    //         $query = $this->conn->prepare($sql);
    //         $create = $query->execute();

    //         return $create;
    //     } catch(PDOException $e){
    //         echo $e;
    //         die();
    //     }
    // }

    public function update($idTransaksi ,$datas)
    {
        $nomorTransaksi = $datas->get('nomorTransaksi');
        $kasirTransaksi = $datas->get('kasirTransaksi');
        $pelangganTransaksi = $datas->get('pelangganTransaksi');
        $tanggalTransaksi = $datas->get('tanggalTransaksi');
        $idClient = $datas->get('idClient');
        $dateCreate = date("Y-m-d");

        $idItem = $datas->get('idItem');
        $kuantitiItem = $datas->get('kuantitiItem');
        $pengurangItem = $datas->get('pengurangItem');

        $sql = "UPDATE ".$this->table. " SET nomorTransaksi = '$nomorTransaksi', kasirTransaksi = '$kasirTransaksi', pelangganTransaksi = '$pelangganTransaksi', tanggalTransaksi = '$tanggalTransaksi', idClient = '$idClient' WHERE idTransaksi = '$idTransaksi'";

        //SQL Creating Group Item
        $deleteGroupitem = "DELETE FROM groupitem WHERE idTransaksi = '$idTransaksi'";
        $sqlGroupitem = "INSERT INTO groupitem VALUES ";
        
        for ($index = 0; $index < count($idItem); $index++){
            $idGroupitem = uniqid('gi');

            if ($index + 1 != count($idItem)){
                $sqlGroupitem .= "('$idGroupitem', '$idTransaksi', '$idItem[$index]', '$pengurangItem[$index]', '$kuantitiItem[$index]', '$dateCreate'),";
            } else {
                $sqlGroupitem .= "('$idGroupitem', '$idTransaksi', '$idItem[$index]', '$pengurangItem[$index]', '$kuantitiItem[$index]', '$dateCreate');";
            }
        }

        try{
            $query = $this->conn->prepare($sql);
            $query->execute();

            $queryDelGroupItem = $this->conn->prepare($deleteGroupitem);
            $queryCreateGroupItem = $this->conn->prepare($sqlGroupitem);

            $queryDelGroupItem->execute();
            $queryCreateGroupItem->execute();

            return $idTransaksi;
        } catch(PDOException $e){
            echo $e;
            die();
        }
    }

    // public function deleteGroupItem($idTransaksi)
    // {
    //     $sql = "DELETE FROM groupitem WHERE idTransaksi = '$idTransaksi'";

    //     try{
    //         $query = $this->conn->prepare($sql);
    //         $delete = $query->execute();

    //         return $delete;
    //     } catch(PDOException $e){
    //         echo $e;
    //         die();
    //     }
    // }

    public function chronologyMessage($action, $user, $object)
    {
        $message = [
            'store' => $user." telah menambah transaksi dengan no_transaksi \"".$object['transaksi']."\"",
            'update' => $user." telah mengubah transaksi dengan no_transaksi \"".$object['transaksi']."\"",
            'delete' => $user." telah menghapus transaksi dengan no_transaksi \"".$object['transaksi']."\"",
            // 'retur' => $user." telah melakukan retur transaksi \"".$object['transaksi']."\" dengan kuantitas ".$object['retur']." ".$object['satuan'],
        ];

        return $message[$action];
    }
    
}

?>