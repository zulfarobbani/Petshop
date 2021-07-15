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
        $sql = "SELECT *, groupItem.kuantitiItem as jumlahBeli FROM groupItem LEFT JOIN item ON item.idItem = groupItem.idItem WHERE idTransaksi = '$idTransaksi'";

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

    public function create($datas)
    {
        $idTransaksi = $datas['idTransaksi'];
        $nomorTransaksi = $datas['nomorTransaksi'];
        $kasirTransaksi = $datas['kasirTransaksi'];
        $pelangganTransaksi = $datas['pelangganTransaksi'];
        $tanggalTransaksi = $datas['tanggalTransaksi'];
        $idGroupitem = $datas['idGroupitem'];
        $idClient = $datas['idClient'];
        $dateCreate = $datas['dateCreate'];
        $kasirTransaksi = 'user98123jsh';
        $statusTransaksi = $datas['statusTransaksi'];

        $sql = "INSERT INTO " . $this->table . " VALUES('$idTransaksi', '$nomorTransaksi', '$kasirTransaksi', '$pelangganTransaksi', '$tanggalTransaksi', '$idGroupitem', '$idClient', '$statusTransaksi', '$dateCreate')";

        try {
            $query = $this->conn->prepare($sql);
            $query->execute();

            return $idTransaksi;
        } catch(PDOException $e){
            echo $e;
            die();
        }
    }

    public function createGroupItem($idGroupitem, $idTransaksi, $idItem, $kuantitiItem)
    {
        $dateCreate = date('Y-m-d');
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

    public function update($idTransaksi, $datas)
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

        $sql = "UPDATE " . $this->table . " SET nomorTransaksi = '$nomorTransaksi', kasirTransaksi = '$kasirTransaksi', pelangganTransaksi = '$pelangganTransaksi', tanggalTransaksi = '$tanggalTransaksi', idClient = '$idClient' WHERE idTransaksi = '$idTransaksi'";

        try {
            $query = $this->conn->prepare($sql);
            $query->execute();

            return $idTransaksi;
        } catch (PDOException $e) {
            echo $e;
            die();
        }
    }

    public function deleteGroupItem($idTransaksi)
    {
        $sql = "DELETE FROM groupitem WHERE idTransaksi = '$idTransaksi'";

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
