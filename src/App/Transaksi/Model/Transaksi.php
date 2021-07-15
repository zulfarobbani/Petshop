<?php

namespace App\Transaksi\Model;

use App\Produk\Model\Produk;
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

    public function selectAll($where = "")
    {
        $sql = "SELECT * FROM " . $this->table . " " . $where;

        try {
            $query = $this->conn->prepare($sql);
            $create = $query->execute();

            $data = $query->fetchAll();

            return $data;
        } catch (PDOException $e) {
            echo $e;
            die();
        }
    }

    public function selectOne($idTransaksi)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE idTransaksi = '$idTransaksi'";

        try {
            $query = $this->conn->prepare($sql);
            $create = $query->execute();

            $data = $query->fetch();

            return $data;
        } catch (PDOException $e) {
            echo $e;
            die();
        }
    }

    public function selectGroupItem($idTransaksi)
    {
        $sql = "SELECT *, groupItem.kuantitiItem as jumlahBeli FROM groupItem LEFT JOIN item ON item.idItem = groupItem.idItem WHERE groupItem.idTransaksi = '$idTransaksi'";

        try {
            $query = $this->conn->prepare($sql);
            $create = $query->execute();
            // $this->dd($create);

            $data = $query->fetchAll();
            // $this->dd($data);
            return $data;
        } catch (PDOException $e) {
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
        $kasirTransaksi = 'user98123jsh';
        $statusTransaksi = $data['statusTransaksi'];

        $sql = "INSERT INTO " . $this->table . " VALUES('$idTransaksi', '$nomorTransaksi', '$kasirTransaksi', '$pelangganTransaksi', '$tanggalTransaksi', '$idGroupitem', '$idClient', '$statusTransaksi', '$dateCreate')";

        try {
            $query = $this->conn->prepare($sql);
            $create = $query->execute();

            return $create;
        } catch (PDOException $e) {
            echo $e;
            die();
        }
    }

    public function createGroupItem($idGroupitem, $idTransaksi, $idItem, $kuantitiItem, $dateCreate)
    {
        $sql = "INSERT INTO groupitem VALUES('$idGroupitem', '$idTransaksi', '$idItem', '', '$kuantitiItem', '$dateCreate')";

        try {
            $query = $this->conn->prepare($sql);
            $create = $query->execute();

            return $create;
        } catch (PDOException $e) {
            echo $e;
            die();
        }
    }

    public function update($idTransaksi, $data)
    {
        $nomorTransaksi = $data['nomorTransaksi'];
        $kasirTransaksi = $data['kasirTransaksi'];
        $pelangganTransaksi = $data['pelangganTransaksi'];
        $tanggalTransaksi = $data['tanggalTransaksi'];
        // $idGroupitem = $data['idGroupitem'];
        $idClient = $data['idClient'];

        $sql = "UPDATE " . $this->table . " SET nomorTransaksi = '$nomorTransaksi', kasirTransaksi = '$kasirTransaksi', pelangganTransaksi = '$pelangganTransaksi', tanggalTransaksi = '$tanggalTransaksi', idClient = '$idClient' WHERE idTransaksi = '$idTransaksi'";

        try {
            $query = $this->conn->prepare($sql);
            $create = $query->execute();

            return $create;
        } catch (PDOException $e) {
            echo $e;
            die();
        }
    }

    public function deleteGroupItem($idGroupitem)
    {
        $sql = "DELETE FROM groupitem WHERE idGroupitem = '$idGroupitem'";

        try {
            $query = $this->conn->prepare($sql);
            $delete = $query->execute();

            return $delete;
        } catch (PDOException $e) {
            echo $e;
            die();
        }
    }

    public function returProduk($idTransaksi, $idItem)
    {
        foreach ($idItem as $key => $value) {
            $sql = "UPDATE groupItem SET pengurangItem = '" . $value . "' WHERE idTransaksi = '$idTransaksi' AND idItem = '$key'";

            try {
                $query = $this->conn->prepare($sql);
                $update = $query->execute();

                // get item
                $produk = new Produk();
                $data_produk = $produk->selectOne($key);

                // update stock product
                $sisaStock = $data_produk['stockItem'] + intval($value);
                $produk->updateStock($key, $sisaStock);

            } catch (PDOException $e) {
                echo $e;
                die();
            }
        }

        return true;
    }
}
