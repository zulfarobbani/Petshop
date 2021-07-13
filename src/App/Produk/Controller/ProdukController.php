<?php

namespace App\Produk\Controller;

use App\Media\Model\Media;
use App\Produk\Model\Produk;
use Core\GlobalFunc;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class ProdukController extends GlobalFunc
{
    public $model;

    public function __construct()
    {
        $this->model = new Produk();
    }

    public function index(Request $request)
    {
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

        $datas = $this->model->selectAll($where);

        return $this->render_template('produk/index', ['datas' => $datas, 'filterWaktumasukFrom' => $filterWaktumasukFrom, 'filterWaktumasukTo' => $filterWaktumasukTo, 'filterWaktuexpiryFrom' => $filterWaktuexpiryFrom, 'filterWaktuexpiryTo' => $filterWaktuexpiryTo]);
    }

    public function create(Request $request)
    {
        return $this->render_template('produk/create');
    }
    public function store(Request $request)
    {
        $produk = $this->model->create($request->request);

        // store foto produk
        $media = new Media();
        $idMedia = uniqid('med');
        $idUser = '1';
        $fotoItem = $media->create($idMedia, $_FILES['fotoItem'], $produk, $idUser);

        return new RedirectResponse('/produk');
    }
    public function edit(Request $request)
    {
        $id = $request->attributes->get('id');
        $datas = $this->model->selectOne($id);

        return $this->render_template('produk/edit', ['datas' => $datas]);
    }
    public function update(Request $request)
    {
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

        return new RedirectResponse('/produk');
    }
    public function delete(Request $request)
    {
        $id = $request->attributes->get('id');
        $this->model->delete($id);

        return new RedirectResponse('/produk');
    }
}
