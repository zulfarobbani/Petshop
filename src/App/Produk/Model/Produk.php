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
        $satuanItem = $datas->get('satuanItem');
        $kuantiti = $datas->get('kuantitiItem');
        $harga = $datas->get('hargaItem');
        $tanggalmasukProduk = $datas->get('tanggalmasukProduk');
        $tanggalexpiryProduk = $datas->get('tanggalexpiryProduk');
        $dateCreate = date('Y-m-d');

        $sql = "INSERT INTO " . $this->table . " VALUES ('$idItem','$namaItem', '$supplierItem', '$satuanItem', '$kuantiti', '$harga', '$kuantiti', '$tanggalmasukProduk', '$tanggalexpiryProduk', '$dateCreate')";

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
        $sql = "SELECT * FROM " . $this->table . " WHERE idItem = '$id'";

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
        $satuanItem = $datas->get('satuanItem');
        $kuantiti = $datas->get('kuantitiItem');
        $harga = $datas->get('hargaItem');
        $tanggalmasukProduk = $datas->get('tanggalmasukProduk');
        $tanggalexpiryProduk = $datas->get('tanggalexpiryProduk');

        $sql = "UPDATE " . $this->table . " SET namaItem = '$namaItem', supplierItem = '$supplierItem', satuanItem = '$satuanItem', kuantitiItem = '$kuantiti', hargaItem = '$harga', tanggalmasukProduk = '$tanggalmasukProduk', tanggalexpiryProduk = '$tanggalexpiryProduk' WHERE idItem = '$id'";

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
}
