<?php

namespace App\Transaksi\Controller;

use App\Produk\Model\Produk;
use App\Chronology\Model\Chronology;
use App\GroupItem\Model\GroupItem;
use App\HargaItem\Model\HargaItem;
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
        if ($this->emailUser == null) {
            return new RedirectResponse('/login');
        }

        if ($request->attributes->get('jenis') != 'grosir' && $request->attributes->get('jenis') != 'eceran') {
            return new RedirectResponse('/transaksi/grosir');
        }
        $jenis = $request->attributes->get('jenis') == 'grosir' ? '1' : '2';

        // filter waktu masuk
        $filterWaktumasukFrom = $request->query->get('filterWaktumasukFrom');
        $filterWaktumasukTo = $request->query->get('filterWaktumasukTo');
        $search = $request->query->get('search');

        $where = "";
        if ($search) {
            $where .= " AND pelangganTransaksi LIKE '%$search%'";
        }

        if ($filterWaktumasukFrom) {
            $where .= " AND ";
            $where .= "transaksi.tanggalTransaksi >= '$filterWaktumasukFrom'";
            if ($filterWaktumasukTo) {
                $where .= " AND transaksi.tanggalTransaksi <= '$filterWaktumasukTo'";
            }
        }

        // pagination
        $page = $request->query->get('page') ? $request->query->get('page') : '1';

        if ($request->query->get('data_per_page') != null) {
            $result_per_page = $request->query->get('data_per_page');

            if ($request->request->get('data_per_page') != null || $request->request->get('data_per_page') != "") {
                $result_per_page = $request->request->get('data_per_page');
            }
        } else {
            if ($request->request->get('data_per_page') != null || $request->request->get('data_per_page') != "") {
                $result_per_page = $request->request->get('data_per_page');
            } else {
                $result_per_page = 10;
            }
        }
		
		$page_first_result = ($page - 1) * $result_per_page;
		$countRows = $this->model->countRows("WHERE jenisTransaksi = '$jenis'" . $where)['count'];
        $number_of_page = ceil($countRows / $result_per_page);

        $datas = $this->model->selectAll("WHERE jenisTransaksi = '$jenis'" . $where . " ORDER BY transaksi.dateCreate DESC LIMIT " . $page_first_result . "," . $result_per_page);

        $pagination = [
            'current_page' => $page,
            'number_of_page' => $number_of_page,
            'page_first_result' => $page_first_result,
            'result_per_page' => $result_per_page,
            'countRows' => $countRows
        ];

        $produk = new Produk();
        $data_produk = $produk->selectAll();

        $groupItem = new GroupItem();
        foreach ($datas as $key => $value) {
            $detail_produk = $groupItem->selectAll("WHERE idTransaksi = '" . $value['idTransaksi'] . "'");
            $total_harga = 0;
            foreach ($detail_produk as $key1 => $value1) {
                if (intval($value1['pengurangItem']) > 0) {
                    $kuantitiItem = intval($value1['groupkuantitiItem'])-intval($value1['pengurangItem']);
                } else {
                    $kuantitiItem = intval($value1['groupkuantitiItem']);
                }
                $total_harga += intval($value1['hargaItemGroup']) * $kuantitiItem;
            }
            $datas[$key]['totalHargaTransaksi'] = $total_harga;
        }

        return $this->render_template('transaksi/transaksi', ['datas' => $datas, 'produk' => $data_produk, 'jenis_transaksi' => $jenis, 'pagination' => $pagination, 'jenis_transaksi_text' => $request->attributes->get('jenis'), 'filterWaktumasukFrom' => $filterWaktumasukFrom, 'filterWaktumasukTo' => $filterWaktumasukTo, 'data_per_page' => $request->query->get('data_per_page'), 'search' => $search]);
    }

    public function create(Request $request)
    {
        if ($this->emailUser == null) {
            return new RedirectResponse('/login');
        }

        $produk = new Produk();
        $data_produk = $produk->selectAll();

        return $this->render_template('transaksi/create', ['produk' => $data_produk]);
    }

    public function store(Request $request)
    {
        if ($this->emailUser == null) {
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
        $dateCreate = date('Y-m-d H:i:s');

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
        $idHargaItem = $request->request->get('idHargaitem');

        $pengurangItem = $request->request->get('pengurangItem');

        for ($index = 0; $index < count($idItem); $index++) {
            $idGroupitem = uniqid('gi');
            $this->model->createGroupItem($idGroupitem, $idTransaksi, $idItem[$index], $kuantitiItem[$index], $satuanItem[$index], $hargaItem[$index], $idHargaItem[$index]);

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

        $redirect = $jenis == 1 ? "grosir" : "eceran";

        return new RedirectResponse('/transaksi/' . $redirect);
    }

    public function edit(Request $request)
    {
        if ($this->emailUser == null) {
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
        if ($this->emailUser == null) {
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
        $idHargaItem = $request->request->get('idHargaitem');

        $this->model->deleteGroupItem($detail['idTransaksi']);

        for ($index = 0; $index < count($idItem); $index++) {
            $idGroupitem = uniqid('gi');
            $this->model->createGroupItem($idGroupitem, $idTransaksi, $idItem[$index], $kuantitiItem[$index], $satuanItem[$index], $hargaItem[$index], $idHargaItem[$index]);

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
        return new RedirectResponse('/transaksi/' . $urlRedirect);
    }

    public function detail(Request $request)
    {
        if ($this->emailUser == null) {
            return new RedirectResponse('/login');
        }

        $idTransaksi = $request->attributes->get('idTransaksi');

        $detail = $this->model->selectOne($idTransaksi);
        // $this->dd($detail);
        $groupItem = $this->model->selectGroupItem($detail['idTransaksi']);

        return $this->render_template('transaksi/detail', ['detail' => $detail, 'groupItem' => $groupItem]);
    }

    public function delete(Request $request)
    {
        $id = $request->attributes->get('id');

        $delete = $this->model->delete($id);
        $groupItem = new GroupItem();
        $groupItem->delete($id);

        // // create chronlogy
        // $chronology = new Chronology();
        // $message = $this->model->chronologyMessage('update', $this->idUser, [
        //     'transaksi' => $detail['nomorTransaksi']
        // ]);
        // $createChronology = $chronology->create($message, $idTransaksi);

        return new RedirectResponse('/transaksi/grosir');
    }

    public function print_receipt(Request $request)
    {
        if ($this->emailUser == null) {
            return new RedirectResponse('/login');
        }

        $idTransaksi = $request->attributes->get('idTransaksi');

        $detail = $this->model->selectOne($idTransaksi);
        $groupItem = $this->model->selectGroupItem($detail['idTransaksi']);

        // $this->dd($groupItem);
        foreach ($groupItem as $key => $value) {
            $groupItem[$key]['jumlahBeli'] = intval($value['jumlahBeli']) - intval($value['pengurangItem']);
        }

        $totalHarga = 0;

        return $this->render_template('transaksi/receiptTransaksi', ['detail' => $detail, 'groupItem' => $groupItem, 'totalHarga' => $totalHarga]);
    }

    public function retur(Request $request)
    {
        if ($this->emailUser == null) {
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
        if ($this->emailUser == null) {
            return new RedirectResponse('/login');
        }

        $idTransaksi = $request->attributes->get('idTransaksi');
        $selectOne = $this->model->selectOne($idTransaksi);
        $this->model->returProduk($idTransaksi, $request->request);

        $redirect = $selectOne['jenisTransaksi'] == '1' ? 'grosir' : 'eceran';

        return new RedirectResponse('/transaksi/'.$redirect);
    }

    public function get(Request $request)
    {
        if ($this->emailUser == null) {
            return new RedirectResponse('/login');
        }

        $idTransaksi = $request->attributes->get('idTransaksi');

        $detail = $this->model->selectOne($idTransaksi);
        $groupItem = $this->model->selectGroupItem($detail['idTransaksi']);

        $hargaItem = new HargaItem();
        foreach ($groupItem as $key => $value) {
            $groupItem[$key]['satuan'] = $hargaItem->selectAll("WHERE idItem = '" . $value['idItem'] . "' AND jenisHargaitem = '" . $detail['jenisTransaksi'] . "'");
        }

        $produk = new Produk();
        $data_produk = $produk->selectAll();

        return new JsonResponse(['detail' => $detail, 'groupItem' => $groupItem, 'produk' => $data_produk]);
    }

    public function report_pdf(Request $request)
    {
        // filter waktu masuk
        $filterWaktumasukFrom = $request->query->get('filterWaktumasukFrom');
        $filterWaktumasukTo = $request->query->get('filterWaktumasukTo');

        $where = "";
        if ($filterWaktumasukFrom) {
            $where = "WHERE ";
            $where .= "transaksi.dateCreate >= '$filterWaktumasukFrom'";
            if ($filterWaktumasukTo) {
                $where .= " AND transaksi.dateCreate <= '$filterWaktumasukTo'";
            }
        }

        // $datas = $this->model->selectAll("WHERE tanggalTransaksi BETWEEN '".$fromDate."' AND '".$toDate."'");
        $datas = $this->model->selectAll($where);

        $produk = new Produk();
        $data_produk = $produk->selectAll();
        $groupItem = new GroupItem();

        $labaKotor = 0;
        $labaBersih = 0;
        $selisih_laba = 0;
        foreach ($datas as $key => $value) {
            $detail_produk = $groupItem->selectAll("WHERE idTransaksi = '" . $value['idTransaksi'] . "'");
            $total_harga = 0;
            $jumlahPengurangan = 0;
            foreach ($detail_produk as $key1 => $value1) {
                if (intval($value1['pengurangItem']) > 0) {
                    $kuantitiItem = intval($value1['groupkuantitiItem'])-intval($value1['pengurangItem']);
                } else {
                    $kuantitiItem = intval($value1['groupkuantitiItem']);
                }
                $total_harga += intval($value1['hargaItemGroup']) * $kuantitiItem;
                $detail_produk[$key1]['totalHarga'] = intval($value1['hargaItemGroup']) * intval($value1['groupkuantitiItem']);
				$detail_produk[$key1]['totalHargaRetur'] = intval($value1['hargaItemGroup']) * $kuantitiItem;
                if ($value1['satuanItemGroup'] == 'Krg' || $value1['satuanItemGroup'] == 'Dus' || $value1['satuanItemGroup'] == 'Set') {
                    $jumlahPengurangan += intval($value1['hargaItem']) * $kuantitiItem;
                } else if ($value1['satuanItemGroup'] == 'Pcs' || $value1['satuanItemGroup'] == 'Kg') {
                    $jumlahPengurangan += intval($value1['hargaperpcsItem']) * $kuantitiItem;
                }
                //$detail_produk[$key1]['totalHargaTransaksi'] = $total_harga;
            }
            $labaKotor += $total_harga;
            $selisih_laba += $jumlahPengurangan;
            $datas[$key]['totalHargaTransaksi'] = $total_harga;
            $datas[$key]['detail'] = $detail_produk;
        }
		
        $labaBersih = $labaKotor - $selisih_laba;

        return $this->render_template('transaksi/riwayatTransaksi', ['datas' => $datas, 'produk' => $data_produk, 'fromDate' => $filterWaktumasukFrom, 'toDate' => $filterWaktumasukTo, 'labaKotor' => $labaKotor, 'labaBersih' => $labaBersih]);
    }
}
