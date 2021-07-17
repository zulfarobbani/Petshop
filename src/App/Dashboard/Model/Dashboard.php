<?php

namespace App\Dashboard\Model;

use Core\GlobalFunc;
use PDOException;

class Dashboard extends GlobalFunc
{
    public $conn;

    public function __construct()
    {
        $globalFunc = new GlobalFunc();
        $this->conn = $globalFunc->conn;
    }

    public function getProdukTerjual()
    {
        $sqlProduk = "SELECT * FROM item";
        $sqlGroupItem = "SELECT * FROM groupitem";

        try{
            $queryProduk = $this->conn->prepare($sqlProduk);
            $queryGroupItem = $this->conn->prepare($sqlGroupItem);

            $queryProduk->execute();
            $queryGroupItem->execute();

            $dataProduk = $queryProduk->fetchAll();
            $dataGroupItem = $queryGroupItem->fetchAll();

            foreach($dataProduk as $key => $produk){

                $produkTerjual = 0;
                foreach($dataGroupItem as $groupitem){
                    if ($produk['idItem'] == $groupitem['idItem']){
                        $produkTerjual += $groupitem['kuantitiItem'];

                        // if ($groupitem['pengurangItem'] != null || $groupitem['pengurangItem'] != ""){
                        //     $produkTerjual -= $groupitem['pengurangItem'];
                        // }
                    }
                }

                $dataProduk[$key]['produkTerjual'] = $produkTerjual;
            }
            
            return $dataProduk;

        } catch (PDOException $e){
            echo $e;
            die();
        }
    }

    public function getSatuan()
    {
        $sqlGetSatuan = "SELECT satuanItem FROM item GROUP BY satuanItem";

        try{

            $queryGetSatuan = $this->conn->prepare($sqlGetSatuan);
            $queryGetSatuan->execute();

            $satuan = $queryGetSatuan->fetchAll();

            return $satuan;
        } catch (PDOException $e){
            echo $e;
            die();
        }
    }

    public function getJumlahProdukPerSatuan($satuanItem)
    {
        $sql = "SELECT SUM(groupitem.kuantitiItem) AS jumlahSatuanItem, item.satuanItem FROM groupitem LEFT JOIN item ON groupitem.idItem = item.idItem WHERE item.satuanItem = '$satuanItem'";

        try{

            $query = $this->conn->prepare($sql);
            $query->execute();

            $data = $query->fetch();

            return $data;
        } catch (PDOException $e){
            echo $e;
            die();
        }
    }

    public function getExpiryStock()
    {
        $sql = "SELECT * FROM item";

        try{

            $query = $this->conn->prepare($sql);
            $query->execute();

            $data_produk = $query->fetchAll();

            $expiry = 0;
            $stock = 0;
            
            foreach($data_produk as $value){
                if (date('Y-m-d') > $value['tanggalexpiryProduk']){
                    $expiry += $value['stockItem'];
                } else {
                    $stock += $value['stockItem'];
                }
            }

            $stock_and_expiry = array(
                "stock" => $stock,
                "expiry" => $expiry
            );

            return $stock_and_expiry;
        } catch (PDOException $e){
            echo $e;
            die();
        }
    }

    public function riwayatTransaksi()
    {

        $sql = "SELECT * FROM transaksi";
        $sqlgroupitem = "SELECT groupitem.*, groupitem.kuantitiItem as jumlahItem, item.* FROM groupitem LEFT JOIN item ON groupitem.idItem = item.idItem";

        try{

            $query = $this->conn->prepare($sql);
            $queryGroupItem = $this->conn->prepare($sqlgroupitem);
            $query->execute();
            $queryGroupItem->execute();

            $transaksi = $query->fetchAll();
            $groupitem = $queryGroupItem->fetchAll();

            $riwayatTransaksi = array();

            foreach($transaksi as $key => $tran){
                array_push($riwayatTransaksi, $tran);

                $riwayatTransaksi[$key]['totalHarga'] = 0;

                foreach($groupitem as $keyitem => $gItem){
                    if ($transaksi[$key]['idTransaksi'] == $groupitem[$keyitem]['idTransaksi']){
                        $riwayatTransaksi[$key]['totalHarga'] += ($gItem['jumlahItem'] * $gItem['hargaItem']);

                    }
                }
            }
            
            return $riwayatTransaksi;
        } catch (PDOException $e){
            echo $e;
            die();
        }
    }

    public function riwayatAktifitas()
    {
        $sql = "SELECT * FROM chronology ORDER BY dateCreate";

        try{

            $query = $this->conn->prepare($sql);
            $query->execute();

            $riwayatAktifitas = $query->fetchAll();

            return $riwayatAktifitas;
        } catch (PDOException $e){
            echo $e;
            die();
        }
    }

    public function totalPerbulan($selectBulan)
    {
        $currentYear = date("Y");

        $sql = "SELECT groupitem.*, groupitem.kuantitiItem as jumlahItem, transaksi.*, item.* FROM groupitem LEFT JOIN transaksi ON groupitem.idTransaksi = transaksi.idTransaksi LEFT JOIN item ON groupitem.idItem = item.idItem WHERE MONTH(transaksi.tanggalTransaksi) = $selectBulan AND YEAR(transaksi.tanggalTransaksi) = $currentYear";

        try{
            $query = $this->conn->prepare($sql);
            $query->execute();

            $dataGroupItem = $query->fetchAll();

            $totalHarga = 0;

            foreach($dataGroupItem as $groupitem){
                $totalHarga += $groupitem['jumlahItem'] * $groupitem['hargaItem'];
            }

            return $totalHarga;
        } catch (PDOException $e){
            echo $e;
            die();
        }
    }
}
