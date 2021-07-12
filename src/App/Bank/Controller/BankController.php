<?php

namespace App\Bank\Controller;

use App\Bank\Model\Bank;
use Core\GlobalFunc;
use Symfony\Component\HttpFoundation\Request;

class BankController extends GlobalFunc
{
    public $model;

    public function __construct()
    {
        $this->model = new Bank();
        parent::beginSession();
    }

    public function index(Request $request)
    {
        $datas = $this->model->selectAll();

        $this->session->set('test', 'bisa');
        $session = $this->session->get('test');

        return $this->render_template('bank/index', ['datas' => $datas, 'session' => $session]);
    }

    public function edit(Request $request)
    {
        $id = $request->attributes->get('id');
        $bank = $this->model->selectOne($id);
        // var_dump($data['namaBank']);
        // die();

        return $this->render_template('bank/edit', ['bank' => $bank]);
    }
}
