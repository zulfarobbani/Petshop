<?php

namespace App\Transaksi\Controller;

use App\Produk\Model\Produk;
use App\Chronology\Model\Chronology;
use App\GroupItem\Model\GroupItem;
use App\Transaksi\Model\Transaksi;
use Core\GlobalFunc;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;

class TransaksiController extends GlobalFunc
{
    public $model;
    public $idUser;
    public $namaUser;
    public $hirarkiUser;
    public $nikUser;
    public $emailUser;

    public function __construct()
    {
        $this->model = new Transaksi();
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
        
        if ($request->attributes->get('jenis') != 'grosir' && $request->attributes->get('jenis') != 'eceran') {
            return new RedirectResponse('/transaksi/grosir');
        }
        $jenis = $request->attributes->get('jenis') == 'grosir' ? '1' : '2';

        // filter waktu masuk
        $filterWaktumasukFrom = $request->query->get('filterWaktumasukFrom');
        $filterWaktumasukTo = $request->query->get('filterWaktumasukTo');

        $where = "";
        if ($filterWaktumasukFrom) {
            $where.= " AND ";
            $where.= "dateCreate >= '$filterWaktumasukFrom'";
            if ($filterWaktumasukTo) {
                $where.= " AND dateCreate <= '$filterWaktumasukFrom'";
            }
        }

        $datas = $this->model->selectAll("WHERE jenisTransaksi = '$jenis'".$where);

        $produk = new Produk();
        $data_produk = $produk->selectAll();

        $groupItem = new GroupItem();
        foreach ($datas as $key => $value) {
            $detail_produk = $groupItem->selectAll("WHERE idTransaksi = '".$value['idTransaksi']."'");
            $total_harga = 0;
            foreach ($detail_produk as $key1 => $value1) {
                $total_harga += intval($value1['hargaItemGroup']);
            }
            $datas[$key]['totalHargaTransaksi'] = $total_harga;
        }
        // $this->dd($datas);

        return $this->render_template('transaksi/transaksi', ['datas' => $datas, 'produk' => $data_produk, 'jenis_transaksi' => $jenis, 'jenis_transaksi_text' => $request->attributes->get('jenis'), 'filterWaktumasukFrom' => $filterWaktumasukFrom, 'filterWaktumasukTo' => $filterWaktumasukTo]);
    }

    public function create(Request $request)
    {
        if ($this->emailUser == null){
            return new RedirectResponse('/login');
        }

        $produk = new Produk();
        $data_produk = $produk->selectAll();

        return $this->render_template('transaksi/create', ['produk' => $data_produk]);
    }

    public function store(Request $request)
    {
        if ($this->emailUser == null){
            return new RedirectResponse('/login');
        }

        // $this->dd($request->request);
        $idTransaksi = uniqid('tran');
        $jenis = $request->request->get('jenishargaItem')[0];

        $nomorTransaksi = $request->request->get('nomorTransaksi'); 
        $pelangganTransaksi = $request->request->get('pelangganTransaksi');
        $kasirTransaksi = $this->namaUser;
        $tanggalTransaksi = $request->request->get('tanggalTransaksi');
        $idClient = $request->request->get('idClient');
        $statusTransaksi = $request->request->get('statusTransaksi');
        $dateCreate = date('Y-m-d');

        $transaksi_arr = array(
            "idTransaksi" => $idTransaksi,
            "nomorTransaksi" => $nomorTransaksi,
            "kasirTransaksi" => $kasirTransaksi,
            "pelangganTransaksi" => $pelangganTransaksi,
            "tanggalTransaksi" => $tanggalTransaksi,
            "idGroupitem" => null,
            "idClient" => $idClient,
            "statusTransaksi" => $statusTransaksi,
            "dateCreate" => $dateCreate,
            "jenisTransaksi" => $jenis,
            "kasirTransaksi" => $this->idUser
        );

        $idItem = $request->request->get('idItem');
        $kuantitiItem = $request->request->get('kuantitiItem');
        $jenishargaItem = $request->request->get('jenishargaItem');
        $satuanItem = $request->request->get('satuanItem');
        $hargaItem = $request->request->get('hargaItem');
        
        $pengurangItem = $request->request->get('pengurangItem');

        for($index = 0; $index < count($idItem); $index++) {
            $idGroupitem = uniqid('gi');
            $this->model->createGroupItem($idGroupitem, $idTransaksi, $idItem[$index], $kuantitiItem[$index], $satuanItem[$index], $hargaItem[$index]);
            
            // get item
            $produk = new Produk();
            $data_produk = $produk->selectOne($idItem[$index]);

            // update stock product
            $sisaStock = $data_produk['stockItem'] - intval($kuantitiItem[$index]);
            $produk->updateStock($idItem[$index], $sisaStock);
        }

        $create = $this->model->create($transaksi_arr);

        // create chronlogy
        $chronology = new Chronology();
        $message = $this->model->chronologyMessage('store', $this->idUser, [
            'transaksi' => $request->request->get('nomorTransaksi')
        ]);
        $createChronology = $chronology->create($message, $create);

        return new RedirectResponse('/transaksi/'.$jenis);
    }

    public function edit(Request $request)
    {
        if ($this->emailUser == null){
            return new RedirectResponse('/login');
        }

        $idTransaksi = $request->attributes->get('idTransaksi');

        $detail = $this->model->selectOne($idTransaksi);
        $groupItem = $this->model->selectGroupItem($detail['idTransaksi']);

        $produk = new Produk();
        $data_produk = $produk->selectAll();

        return $this->render_template('transaksi/edit', ['detail' => $detail, 'groupItem' => $groupItem, 'produk' => $data_produk]);
    }

    public function update(Request $request)
    {
        if ($this->emailUser == null){
            return new RedirectResponse('/login');
        }

        $idTransaksi = $request->attributes->get('idTransaksi');
        $jenis = $request->request->get('jenishargaItem')[0];

        $kasirTransaksi = $this->idUser;
        $update = $this->model->update($idTransaksi, $request->request, $kasirTransaksi);

        $detail = $this->model->selectOne($idTransaksi);

        $idItem = $request->request->get('idItem');
        $kuantitiItem = $request->request->get('kuantitiItem');
        $pengurangItem = $request->request->get('pengurangItem');
        $satuanItem = $request->request->get('satuanItem');
        $hargaItem = $request->request->get('hargaItem');

        $this->model->deleteGroupItem($detail['idTransaksi']);

        for($index = 0; $index < count($idItem); $index++){
            $idGroupitem = uniqid('gi');
            $this->model->createGroupItem($idGroupitem, $idTransaksi, $idItem[$index], $kuantitiItem[$index], $satuanItem[$index], $hargaItem[$index]);

            // get item
            $produk = new Produk();
            $data_produk = $produk->selectOne($idItem[$index]);

            // update stock product
            // $sisaStock = $data_produk['stockItem'] - intval($kuantitiItem[$index]);
            // $produk->updateStock($idItem[$index], $sisaStock);
        }

        // create chronlogy
        $chronology = new Chronology();
        $message = $this->model->chronologyMessage('update', $this->idUser, [
            'transaksi' => $detail['nomorTransaksi']
        ]);
        $createChronology = $chronology->create($message, $idTransaksi);

        $urlRedirect = $request->request->get('jenishargaItem')[0] == '1' ? 'grosir' : 'eceran';
        return new RedirectResponse('/transaksi/'.$urlRedirect);
    }

    public function detail(Request $request)
    {
        if ($this->emailUser == null){
            return new RedirectResponse('/login');
        }

        $idTransaksi = $request->attributes->get('idTransaksi');

        $detail = $this->model->selectOne($idTransaksi);
        // $this->dd($detail);
        $groupItem = $this->model->selectGroupItem($detail['idTransaksi']);

        return $this->render_template('transaksi/detail', ['detail' => $detail, 'groupItem' => $groupItem]);
    }

    // public function delete(Request $request)
    // {
    //     $id_user = $request->attributes->get('id_user');

    //     $delete = $this->model->delete($id_user);

    //     // create chronlogy
    //     $chronology = new Chronology();
    //     $message = $this->model->chronologyMessage('update', $this->idUser, [
    //         'transaksi' => $detail['nomorTransaksi']
    //     ]);
    //     $createChronology = $chronology->create($message, $idTransaksi);

    //     return new RedirectResponse('/users');
    // }

    public function print_receipt(Request $request)
    {
        if ($this->emailUser == null){
            return new RedirectResponse('/login');
        }

        $idTransaksi = $request->attributes->get('idTransaksi');

        $detail = $this->model->selectOne($idTransaksi);
        $groupItem = $this->model->selectGroupItem($detail['idTransaksi']);
        
        $totalHarga = 0;

        return $this->render_template('transaksi/receiptTransaksi', ['detail' => $detail, 'groupItem' => $groupItem, 'totalHarga' => $totalHarga]);
    }

    public function retur(Request $request)
    {
        if ($this->emailUser == null){
            return new RedirectResponse('/login');
        }

        $idTransaksi = $request->attributes->get('idTransaksi');

        $detail = $this->model->selectOne($idTransaksi);
        $groupItem = $this->model->selectGroupItem($detail['idTransaksi']);

        $produk = new Produk();
        $data_produk = $produk->selectAll();

        return $this->render_template('transaksi/retur', ['detail' => $detail, 'groupItem' => $groupItem, 'produk' => $data_produk]);
    }

    public function retur_store(Request $request)
    {
        if ($this->emailUser == null){
            return new RedirectResponse('/login');
        }

        $idTransaksi = $request->attributes->get('idTransaksi');
        $this->model->returProduk($idTransaksi, $request->request);

        return new RedirectResponse('/transaksi');
    }

    public function get(Request $request)
    {
        if ($this->emailUser == null){
            return new RedirectResponse('/login');
        }
        
        $idTransaksi = $request->attributes->get('idTransaksi');

        $detail = $this->model->selectOne($idTransaksi);
        $groupItem = $this->model->selectGroupItem($detail['idTransaksi']);

        $produk = new Produk();
        $data_produk = $produk->selectAll();

        return new JsonResponse(['detail' => $detail, 'groupItem' => $groupItem, 'produk' => $data_produk]);
    }

    public function report_pdf(Request $request)
    {
        $fromDate = '2021-07-16';
        $toDate = date('Y-m-d');

        $datas = $this->model->selectAll("WHERE tanggalTransaksi BETWEEN '".$fromDate."' AND '".$toDate."'");

        $produk = new Produk();
        $data_produk = $produk->selectAll();

        $groupItem = new GroupItem();
        foreach ($datas as $key => $value) {
            $detail_produk = $groupItem->selectAll("WHERE idTransaksi = '".$value['idTransaksi']."'");
            $total_harga = 0;
            foreach ($detail_produk as $key1 => $value1) {
                $total_harga += intval($value1['hargaItem']);
            }
            $datas[$key]['totalHargaTransaksi'] = $total_harga;
        }

        return $this->render_template('transaksi/riwayatTransaksi', ['datas' => $datas, 'produk' => $data_produk, 'fromDate' => $fromDate, 'toDate' => $toDate]);
    }
}
