<?php

namespace App\Dashboard\Controller;

use App\Dashboard\Model\Dashboard;
use App\Transaksi\Model\Transaksi;
use App\Produk\Model\Produk;
use App\GroupItem\Model\GroupItem;
use Core\GlobalFunc;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;

class DashboardController extends GlobalFunc
{
    public $model;
    public $modelTransaksi;
    public $modelProduk;
    public $modelGroupItem;

    public $idUser;
    public $namaUser;
    public $hirarkiUser;
    public $nikUser;
    public $emailUser;

    public function __construct()
    {
        $this->model = new Dashboard();
        $this->modelTransaksi = new Transaksi();
        $this->modelProduk = new Produk();
        $this->modelGroupItem = new GroupItem();

        parent::beginSession();
        $this->idUser = $this->session->get('idUser');
        $this->namaUser = $this->session->get('namaUser');
        $this->hirarkiUser = $this->session->get('hirarkiUser');
        $this->nikUser = $this->session->get('nikUser');
        $this->emailUser = $this->session->get('emailUser');
    }

    public function index(Request $request)
    {
        if ($this->emailUser == null){
            return new RedirectResponse('/login');
        }

        // filter waktu masuk
        $filterWaktumasukFrom = $request->query->get('filterWaktumasukFrom');
        $filterWaktumasukTo = $request->query->get('filterWaktumasukTo');

        $where = "";
        if ($filterWaktumasukFrom) {
            $where.= "WHERE ";
            $where.= "transaksi.dateCreate >= '$filterWaktumasukFrom'";
            if ($filterWaktumasukTo) {
                $where.= " AND transaksi.dateCreate <= '$filterWaktumasukTo'";
            }
        }

        // $this->dd($where);

        //Data Expire Dan Stock
        $dataExpireStock = $this->model->getExpiryStock();

        //Data For Grafik Penjualan Berdasarkan Produk
        $data_produk = $this->model->getAllItem();

        $idItem = $request->request->get('idProduk');
        $whereProduk = "";

        if ($idItem != null || $idItem != ""){
            $whereProduk .= " WHERE idItem = '".$idItem."'";
        } else {
            $whereProduk .= " LIMIT 0,10";
        }

        $dataPenjualanProduk = $this->model->getProdukTerjual($whereProduk);
        
        //Data For Grafik Penjualan Berdasarkan Satuan
        $satuanItem = $this->model->getSatuan();

        $dataPenjualanSatuan = array();

        foreach($satuanItem as $satuan){

            $jumlahProdukPerSatuan = $this->model->getJumlahProdukPerSatuan($satuan['satuanHargaitem']);

            array_push($dataPenjualanSatuan, array(
                "satuan" => $satuan['satuanHargaitem'],
                "jumlah" => $jumlahProdukPerSatuan['jumlahSatuanItem']
            ));
        }

        //Data For Total Penjualan Perbulan
        $getTotalPenjualanPerbulan = function($selectMonth){
            $totalPenjualanPerbulan = $this->model->totalPerbulan($selectMonth);

            return $totalPenjualanPerbulan;
        };

        //Data For Riwayat Transaksi
        $dataTransaksi = $this->modelTransaksi->selectAll($where." ORDER BY dateTransaksi DESC");
        $data_produk = $this->modelProduk->selectAll();
        $labaKotor = 0;
        $labaBersih = 0;
        $selisih_laba = 0;
        foreach ($dataTransaksi as $key => $value) {
            $detail_produk = $this->modelGroupItem->selectAll("WHERE idTransaksi = '".$value['idTransaksi']."'");
            $total_harga = 0;
            $jumlahPengurangan = 0;
            foreach ($detail_produk as $key1 => $value1) {
                if (intval($value1['pengurangItem']) > 0) {
                    $kuantitiItem = intval($value1['groupkuantitiItem'])-intval($value1['pengurangItem']);
                } else {
                    $kuantitiItem = intval($value1['groupkuantitiItem']);
                }
                $total_harga += intval($value1['hargaItemGroup']) * $kuantitiItem;
                if ($value1['satuanItemGroup'] == 'Krg' || $value1['satuanItemGroup'] == 'Dus' || $value1['satuanItemGroup'] == 'Set') {
                    $jumlahPengurangan += intval($value1['hargaItem']) * $kuantitiItem;
                } else if ($value1['satuanItemGroup'] == 'Pcs' || $value1['satuanItemGroup'] == 'Kg') {
                    $jumlahPengurangan += intval($value1['hargaperpcsItem']) * $kuantitiItem;
                }
            }
            $dataTransaksi[$key]['totalHargaTransaksi'] = $total_harga;
            $labaKotor+= $total_harga;
            $selisih_laba+= $jumlahPengurangan;
        }
        $labaBersih = $labaKotor - $selisih_laba;
        // $this->dd($labaBersih);

        // //Data For Riwayat Aktifitas'
        // $riwayatAktifitas = $this->model->riwayatAktifitas();
        
        return $this->render_template('dashboard/index', ['data_produk' => $data_produk ,'dataPenjualanProduk' => $dataPenjualanProduk, 'dataPenjualanSatuan' => $dataPenjualanSatuan, 'dataExpireStock' => $dataExpireStock, 'dataTransaksi' => $dataTransaksi, 'getTotalPenjualanPerbulan' => $getTotalPenjualanPerbulan, 'labaBersih' => $labaBersih, 'labaKotor' => $labaKotor, 'filterWaktumasukFrom' => $filterWaktumasukFrom, 'filterWaktumasukTo' => $filterWaktumasukTo]);
    }

}
