<?php

namespace App\Produk\Controller;

use App\Chronology\Model\Chronology;
use App\Media\Model\Media;
use App\Produk\Model\Produk;
use Core\GlobalFunc;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class ProdukController extends GlobalFunc
{
    public $model;
    public $idUser;
    public $namaUser;
    public $hirarkiUser;
    public $nikUser;
    public $emailUser;

    public function __construct()
    {
        $this->model = new Produk();
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

        $where = "";
        
        // filter waktu masuk
        $filterWaktumasukFrom = $request->query->get('filterWaktumasukFrom');
        $filterWaktumasukTo = $request->query->get('filterWaktumasukTo');

        if ($filterWaktumasukFrom) {
            $where.= "WHERE ";
            $where.= "tanggalmasukProduk >= '$filterWaktumasukFrom'";
            if ($filterWaktumasukTo) {
                $where.= " AND tanggalmasukProduk <= '$filterWaktumasukFrom'";
            }
        }

        // filter waktu expiry
        $filterWaktuexpiryFrom = $request->query->get('filterWaktuexpiryFrom');
        $filterWaktuexpiryTo = $request->query->get('filterWaktuexpiryTo');

        if ($filterWaktuexpiryFrom) {
            $where.= $filterWaktumasukFrom ?  " AND " : "WHERE ";
            if ($filterWaktuexpiryTo) {
                $where.= " tanggalexpiryProduk BETWEEN '$filterWaktuexpiryFrom' AND '$filterWaktuexpiryTo'";
            } else {
                $where.= "tanggalexpiryProduk = '$filterWaktuexpiryFrom'";
            }
        }

        // pagination
        $countRows = $this->model->countRows()['count'];
        $page = $request->query->get('page') ? $request->query->get('page') : '1';

        if ($request->query->get('data_per_page') != null){
            $result_per_page = $request->query->get('data_per_page');

            if ($request->request->get('data_per_page') != null || $request->request->get('data_per_page') != ""){
                $result_per_page = $request->request->get('data_per_page');
            }
        } else {
            if ($request->request->get('data_per_page') != null || $request->request->get('data_per_page') != ""){
                $result_per_page = $request->request->get('data_per_page');
            } else {
                $result_per_page = 10;
            }
        }

        $page_first_result = ($page-1)*$result_per_page;
        $number_of_page = ceil($countRows/$result_per_page);

        $datas = $this->model->selectAll($where." LIMIT ".$page_first_result.",".$result_per_page);
        $pagination = [
            'current_page' => $page,
            'number_of_page' => $number_of_page,
            'page_first_result' => $page_first_result,
            'result_per_page' => $result_per_page,
            'countRows' => $countRows
        ];

        return $this->render_template('produk/produk', ['datas' => $datas, 'filterWaktumasukFrom' => $filterWaktumasukFrom, 'filterWaktumasukTo' => $filterWaktumasukTo, 'filterWaktuexpiryFrom' => $filterWaktuexpiryFrom, 'filterWaktuexpiryTo' => $filterWaktuexpiryTo, 'pagination' => $pagination]);
    }

    public function create(Request $request)
    {
        if ($this->emailUser == null){
            return new RedirectResponse('/login');
        }

        return $this->render_template('produk/create');
    }
    public function store(Request $request)
    {
        if ($this->emailUser == null){
            return new RedirectResponse('/login');
        }
        
        $produk = $this->model->create($request->request);

        // store foto produk
        $media = new Media();
        $idMedia = uniqid('med');
        $idUser = '1';
        $fotoItem = $media->create($idMedia, $_FILES['fotoItem'], $produk, $idUser);

        // create chronlogy
        $chronology = new Chronology();
        $message = $this->model->chronologyMessage('store', 'User 1', [
            'produk' => $request->request->get('namaItem')
        ]);
        $createChronology = $chronology->create($message, $produk);

        return new RedirectResponse('/produk');
    }
    public function edit(Request $request)
    {
        if ($this->emailUser == null){
            return new RedirectResponse('/login');
        }

        $id = $request->attributes->get('id');
        $datas = $this->model->selectOne($id);

        return $this->render_template('produk/edit', ['datas' => $datas]);
    }
    public function update(Request $request)
    {
        if ($this->emailUser == null){
            return new RedirectResponse('/login');
        }

        $id = $request->attributes->get('id');
        $item = $this->model->update($id, $request->request);

        if ($_FILES['fotoItem']['name'] != '') {
            $media = new Media();
            // select existing foto item
            $selectItem = $media->selectOneMedia("idRelation = '$id'");
            // delete existing foto item
            $deleteFotoItem = $media->delete($selectItem['idMedia']);
            // delete file foto item
            $deleteFileFotoItam = $media->deleteFile($selectItem['pathMedia']);

            $idMedia = uniqid('med');
            $idUser = '1';
            $fotoItem = $media->create($idMedia, $_FILES['fotoItem'], $item, $idUser);
        }

        // create chronlogy
        $chronology = new Chronology();
        $message = $this->model->chronologyMessage('update', 'User 1', [
            'produk' => $request->request->get('namaItem')
        ]);
        $createChronology = $chronology->create($message, $item);

        return new RedirectResponse('/produk');
    }
    public function delete(Request $request)
    {
        if ($this->emailUser == null){
            return new RedirectResponse('/login');
        }

        $id = $request->attributes->get('id');
        $datas = $this->model->selectOne($id);
        $this->model->delete($id);

        $media = new Media();
        // select existing media foto produk
        $selectProduk = $media->selectOneMedia("idRelation = '$id'");
        // delete existing media foto produk
        $deleteFotoProduk = $media->delete($selectProduk['idMedia']);
        // delete file media foto produk
        $deleteFileFotoProduk = $media->deleteFile($selectProduk['pathMedia']);

        // create chronlogy
        $chronology = new Chronology();
        $message = $this->model->chronologyMessage('delete', 'User 1', [
            'produk' => $datas['namaItem']
        ]);
        $createChronology = $chronology->create($message, $id);

        return new RedirectResponse('/produk');
    }

    public function get_all(Request $request)
    {
        if ($this->emailUser == null){
            return new RedirectResponse('/login');
        }
        
        $datas = $this->model->selectAll();

        return new JsonResponse([
            'datas' => $datas
        ]);
    }

    public function get(Request $request)
    {
        if ($this->emailUser == null){
            return new RedirectResponse('/login');
        }

        $id = $request->attributes->get('id');
        $data = $this->model->selectOne($id);

        return new JsonResponse([
            'data' => $data
        ]);
    }

    public function activity(Request $request)
    {
        if ($this->emailUser == null){
            return new RedirectResponse('/login');
        }
        
        $id = $request->attributes->get('id');
        $data = $this->model->selectOne($id);
        $aktivitas = new Chronology();
        $data_aktivitas = $aktivitas->selectAll("WHERE idTables = '".$data['idItem']."'");

        return new JsonResponse([
            'data' => $data_aktivitas
        ]);
    }
}
