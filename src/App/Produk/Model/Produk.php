<?php

namespace App\Produk\Model;

use App\GroupItem\Model\GroupItem;
use App\Transaksi\Model\Transaksi;
use Core\GlobalFunc;
use PDOException;

class Produk extends GlobalFunc
{
    private $table = 'item';
    private $primaryKey = 'idItem';
    public $conn;

    public function __construct()
    {
        $globalFunc = new GlobalFunc();
        $this->conn = $globalFunc->conn;
    }

    public function countRows($where = "")
    {
        $sql = "SELECT COUNT(".$this->primaryKey.") as count FROM " . $this->table . " " .$where;

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
        $sql = "SELECT * FROM " . $this->table . " " . $where;

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

    public function create($datas)
    {
        $idItem = uniqid('itm');
        $namaItem = $datas->get('namaItem');
        $supplierItem = $datas->get('supplierItem');
        $kuantiti = $datas->get('kuantitiItem');
        $harga = $datas->get('hargaItem');
        $hargaperpcsItem = $datas->get('hargaperpcsItem');
        $tanggalmasukProduk = $datas->get('tanggalmasukProduk');
        $tanggalexpiryProduk = $datas->get('tanggalexpiryProduk');
        $dateCreate = date('Y-m-d');

        $sql = "INSERT INTO " . $this->table . " VALUES ('$idItem','$namaItem', '$supplierItem', '$kuantiti', '$harga', '$hargaperpcsItem', '$kuantiti', '$tanggalmasukProduk', '$tanggalexpiryProduk', '$dateCreate')";

        try {
            $data = $this->conn->prepare($sql);
            $data->execute();

            return $idItem;
        } catch (PDOException $e) {
            echo $e;
            die();
        }
    }

    public function insert($datas)
    {
        $idItem = uniqid('itm');
        $namaItem = $datas['namaItem'];
        $supplierItem = $datas['supplierItem'];
        $kuantiti = $datas['kuantitiItem'];
        $harga = $datas['hargaItem'];
        $hargaperpcsItem = $datas['hargaperpcsItem'];
        $tanggalmasukProduk = $datas['tanggalmasukProduk'];
        $tanggalexpiryProduk = $datas['tanggalexpiryProduk'];
        $dateCreate = date('Y-m-d');

        $sql = "INSERT INTO " . $this->table . " VALUES ('$idItem','$namaItem', '$supplierItem', '$kuantiti', '$harga', '$hargaperpcsItem', '$kuantiti', '$tanggalmasukProduk', '$tanggalexpiryProduk', '$dateCreate')";

        try {
            $data = $this->conn->prepare($sql);
            $data->execute();

            return $idItem;
        } catch (PDOException $e) {
            echo $e;
            die();
        }
    }

    public function selectOne($id)
    {
        $sql = "SELECT * FROM " . $this->table . " LEFT JOIN media ON media.idRelation = ".$this->table.".idItem WHERE idItem = '$id'";

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
    public function update($id, $datas)
    {
        $namaItem = $datas->get('namaItem');
        $supplierItem = $datas->get('supplierItem');
        $kuantiti = $datas->get('kuantitiItem');
        $harga = $datas->get('hargaItem');
        $hargaperpcsItem = $datas->get('hargaperpcsItem');
        $tanggalmasukProduk = $datas->get('tanggalmasukProduk');
        $tanggalexpiryProduk = $datas->get('tanggalexpiryProduk');

        $sql = "UPDATE " . $this->table . " SET namaItem = '$namaItem', supplierItem = '$supplierItem', kuantitiItem = '$kuantiti', hargaItem = '$harga', hargaperpcsItem = '$hargaperpcsItem', tanggalmasukProduk = '$tanggalmasukProduk', tanggalexpiryProduk = '$tanggalexpiryProduk' WHERE idItem = '$id'";

        try {
            $data = $this->conn->prepare($sql);
            $data->execute();

            return $id;
        } catch (PDOexception $e) {
            echo $e;
            die();
        }
    }

    public function delete($id)
    {
        $sql = "DELETE FROM " . $this->table . " WHERE idItem = '$id'";

        try {
            $query = $this->conn->prepare($sql);
            $query->execute();
            return $query;
        } catch (PDOException $e) {
            dump($e);
            die();
        }
    }

    public function chronologyMessage($action, $user, $object)
    {
        $message = [
            'store' => $user." telah menambah produk \"".$object['produk']."\"",
            'update' => $user." telah mengubah produk \"".$object['produk']."\"",
            'delete' => $user." telah menghapus produk \"".$object['produk']."\"",
            'retur' => $user." telah melakukan retur produk \"".$object['produk']."\" dengan kuantitas ".$object['retur']." ".$object['satuan'],
        ];

        return $message[$action];
    }

    public function updateStock($id, $sisaStock)
    {
        $sql = "UPDATE " . $this->table . " SET stockItem = '$sisaStock' WHERE idItem = '$id'";

        try {
            $data = $this->conn->prepare($sql);
            $data->execute();

            return $id;
        } catch (PDOexception $e) {
            echo $e;
            die();
        }
    }
}
