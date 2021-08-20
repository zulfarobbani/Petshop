<?php

namespace App\HargaItem\Model;

use App\GroupItem\Model\GroupItem;
use App\Transaksi\Model\Transaksi;
use Core\GlobalFunc;
use PDOException;

class HargaItem extends GlobalFunc
{
    private $table = 'hargaItem';
    private $primaryKey = 'idHargaitem';
    public $conn;

    public function __construct()
    {
        $globalFunc = new GlobalFunc();
        $this->conn = $globalFunc->conn;
    }

    public function countRows()
    {
        $sql = "SELECT COUNT(" . $this->primaryKey . ") as count FROM " . $this->table;

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

    public function create($id, $datas)
    {
        foreach ($datas->get('satuanHarga') as $key => $value) {
            $idHargaitem = uniqid('htm');
            $satuanHargaitem = $datas->get('satuanHarga')[$key];
            $jenisHargaitem = $datas->get('jenisHarga')[$key];
            $hargaHarga = $datas->get('hargaHarga')[$key];
            $dateCreate = date('Y-m-d');

            $sql = "INSERT INTO " . $this->table . " VALUES ('$idHargaitem','$id', '$satuanHargaitem', '$jenisHargaitem', '$hargaHarga', '$dateCreate')";

            try {
                $data = $this->conn->prepare($sql);
                $data->execute();
                // $this->dd($data->execute());
            } catch (PDOException $e) {
                echo $e;
                die();
            }
        }

        return true;
    }

    public function insert($id, $datas)
    {
        $idHargaitem = uniqid('htm');
        $satuanHargaitem = $datas['satuanHarga'];
        $jenisHargaitem = $datas['jenisHarga'];
        $hargaHarga = $datas['hargaHarga'];
        $dateCreate = date('Y-m-d');

        $sql = "INSERT INTO " . $this->table . " VALUES ('$idHargaitem','$id', '$satuanHargaitem', '$jenisHargaitem', '$hargaHarga', '$dateCreate')";

        try {
            $data = $this->conn->prepare($sql);
            $data->execute();
            
            return $idHargaitem;
        } catch (PDOException $e) {
            echo $e;
            die();
        }
    }

    public function selectOne($id)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE " . $this->primaryKey . " = '$id'";

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
        $idItem = $datas->get('idItem');
        $satuanHargaitem = $datas->get('satuanHargaitem');
        $jenisHargaitem = $datas->get('jenisHargaitem');

        $sql = "UPDATE " . $this->table . " SET idItem = '$idItem', satuanHargaitem = '$satuanHargaitem', jenisHargaitem = '$jenisHargaitem' WHERE " . $this->primaryKey . " = '$id'";

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
        $sql = "DELETE FROM " . $this->table . " WHERE " . $this->primaryKey . " = '$id'";

        try {
            $query = $this->conn->prepare($sql);
            $query->execute();
            return $query;
        } catch (PDOException $e) {
            dump($e);
            die();
        }
    }

    public function deleteByItem($id)
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
            'store' => $user . " telah menambah harga produk \"" . $object['produk'] . "\"",
            'update' => $user . " telah mengubah harga produk \"" . $object['produk'] . "\"",
            'delete' => $user . " telah menghapus harga produk \"" . $object['produk'] . "\"",
        ];

        return $message[$action];
    }
}
