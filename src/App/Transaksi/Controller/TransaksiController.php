<?php

namespace App\Transaksi\Controller;

use App\Chronology\Model\Chronology;
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

        $create = $this->model->create($request->request);

        // create chronlogy
        $chronology = new Chronology();
        $message = $this->model->chronologyMessage('store', 'User 1', [
            'transaksi' => $request->request->get('nomorTransaksi')
        ]);
        $createChronology = $chronology->create($message, $create);

        return new RedirectResponse('/transaksi');
    }

    public function edit(Request $request)
    {
        $idTransaksi = $request->attributes->get('idTransaksi');

        $detail = $this->model->selectOne($idTransaksi);
        $groupItem = $this->model->selectGroupItem($idTransaksi);

        return $this->render_template('transaksi/edit', ['detail' => $detail, 'groupItem' => $groupItem]);
    }

    public function update(Request $request)
    {
        $idTransaksi = $request->attributes->get('idTransaksi');

        $update = $this->model->update($idTransaksi, $request->request);

        $detail = $this->model->selectOne($idTransaksi);

        // create chronlogy
        $chronology = new Chronology();
        $message = $this->model->chronologyMessage('update', 'User 1', [
            'transaksi' => $detail['nomorTransaksi']
        ]);
        $createChronology = $chronology->create($message, $idTransaksi);

        return new RedirectResponse('/transaksi');
    }

    public function detail(Request $request)
    {
        $idTransaksi = $request->attributes->get('idTransaksi');

        $detail = $this->model->selectOne($idTransaksi);
        $groupItem = $this->model->selectGroupItem($detail['idGroupitem']);

        return $this->render_template('transaksi/detail', ['detail' => $detail, 'groupItem' => $groupItem]);

    }

    // public function delete(Request $request)
    // {
    //     $id_user = $request->attributes->get('id_user');

    //     $delete = $this->model->delete($id_user);

    //     // create chronlogy
    //     $chronology = new Chronology();
    //     $message = $this->model->chronologyMessage('update', 'User 1', [
    //         'transaksi' => $detail['nomorTransaksi']
    //     ]);
    //     $createChronology = $chronology->create($message, $idTransaksi);

    //     return new RedirectResponse('/users');
    // }

    public function print_receipt(Request $request)
    {
        $idTransaksi = $request->attributes->get('idTransaksi');

        $detail = $this->model->selectOne($idTransaksi);
        $groupItem = $this->model->selectGroupItem($detail['idGroupitem']);
        
        $totalHarga = 0;

        return $this->render_template('transaksi/receiptTransaksi', ['detail' => $detail, 'groupItem' => $groupItem, 'totalHarga' => $totalHarga]);
    }
}
