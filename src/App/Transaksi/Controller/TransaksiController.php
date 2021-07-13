<?php

namespace App\Transaksi\Controller;

use App\Transaksi\Model\Transaksi;
use Core\GlobalFunc;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;

class TransaksiController extends GlobalFunc
{
    public $model;

    public function __construct()
    {
        $this->model = new Transaksi();
    }

    public function index(Request $request)
    {
        $datas = $this->model->selectAll();
        
        $selectTransaksi = function($idTransaksi){
            $data = $this->model->selectOne($idTransaksi);

            return $data;
        };

        $selectGroupItem = function($idTransaksi){
            $data = $this->model->selectGroupItem($idTransaksi);

            return $data;
        };

        return $this->render_template('transaksi/index', ['datas' => $datas, '$selectTransaksi' => $selectTransaksi, 'selectGroupItem' => $selectGroupItem]);
    }

    public function create(Request $request)
    {
        return $this->render_template('transaksi/create');
    }

    public function store(Request $request)
    {
        
        $idTransaksi = uniqid('tran');
        $idGroupitem = uniqid('gi');

        $nomorTransaksi = $request->request->get('nomorTransaksi');
        $pelangganTransaksi = $request->request->get('pelangganTransaksi');
        $kasirTransaksi = $request->request->get('kasirTransaksi');
        $tanggalTransaksi = $request->request->get('tanggalTransaksi');
        $idClient = $request->request->get('idClient');
        $dateCreate = date('Y-m-d');

        $transaksi_arr = array(
            "idTransaksi" => $idTransaksi,
            "nomorTransaksi" => $nomorTransaksi,
            "kasirTransaksi" => $kasirTransaksi,
            "pelangganTransaksi" => $pelangganTransaksi,
            "tanggalTransaksi" => $tanggalTransaksi,
            "idGroupitem" => $idGroupitem,
            "idClient" => $idClient,
            "dateCreate" => $dateCreate
        );

        $idItem = $request->request->get('idItem');
        $kuantitiItem = $request->request->get('kuantitiItem');
        $pengurangItem = $request->request->get('pengurangItem');

        for($index = 0; $index < count($idItem); $index++){
            $this->model->createGroupItem($idGroupitem, $idItem[$index], $pengurangItem[$index], $kuantitiItem[$index], $dateCreate);
        }

        $create = $this->model->create($transaksi_arr);

        return new RedirectResponse('/transaksi');
    }

    public function edit(Request $request)
    {
        $idTransaksi = $request->attributes->get('idTransaksi');

        $detail = $this->model->selectOne($idTransaksi);
        $groupItem = $this->model->selectGroupItem($detail['idGroupitem']);

        return $this->render_template('transaksi/edit', ['detail' => $detail, 'groupItem' => $groupItem]);
    }

    public function update(Request $request)
    {
        $idTransaksi = $request->attributes->get('idTransaksi');

        $nomorTransaksi = $request->request->get('nomorTransaksi');
        $pelangganTransaksi = $request->request->get('pelangganTransaksi');
        $kasirTransaksi = $request->request->get('kasirTransaksi');
        $tanggalTransaksi = $request->request->get('tanggalTransaksi');
        $idClient = $request->request->get('idClient');
        $dateCreate = date('Y-m-d');

        $transaksi_arr = array(
            "nomorTransaksi" => $nomorTransaksi,
            "kasirTransaksi" => $kasirTransaksi,
            "pelangganTransaksi" => $pelangganTransaksi,
            "tanggalTransaksi" => $tanggalTransaksi,
            // "idGroupitem" => $idGroupitem,
            "idClient" => $idClient
            // "dateCreate" => $dateCreate
        );

        $update = $this->model->update($idTransaksi, $transaksi_arr);

        $detail = $this->model->selectOne($idTransaksi);

        $idItem = $request->request->get('idItem');
        $kuantitiItem = $request->request->get('kuantitiItem');
        $pengurangItem = $request->request->get('pengurangItem');

        $this->model->deleteGroupItem($detail['idGroupitem']);

        for($index = 0; $index < count($idItem); $index++){
            $this->model->createGroupItem($detail['idGroupitem'], $idItem[$index], $pengurangItem[$index], $kuantitiItem[$index], $dateCreate);
        }


        return new RedirectResponse('/transaksi');
    }

    public function detail(Request $request)
    {
        $idTransaksi = $request->attributes->get('idTransaksi');

        $detail = $this->model->selectOne($idTransaksi);
        $groupItem = $this->model->selectGroupItem($detail['idGroupitem']);

        return $this->render_template('transaksi/detail', ['detail' => $detail, 'groupItem' => $groupItem]);

    }

    public function delete(Request $request)
    {
        $id_user = $request->attributes->get('id_user');

        $delete = $this->model->delete($id_user);

        return new RedirectResponse('/users');
    }

    public function print_receipt(Request $request)
    {
        $idTransaksi = $request->attributes->get('idTransaksi');

        $detail = $this->model->selectOne($idTransaksi);
        $groupItem = $this->model->selectGroupItem($detail['idGroupitem']);
        
        $totalHarga = 0;

        return $this->render_template('transaksi/receiptTransaksi', ['detail' => $detail, 'groupItem' => $groupItem, 'totalHarga' => $totalHarga]);
    }
}
