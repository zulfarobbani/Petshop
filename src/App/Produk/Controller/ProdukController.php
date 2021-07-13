<?php

namespace App\Produk\Controller;

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
        $datas = $this->model->selectAll();

        return $this->render_template('produk/index', ['datas' => $datas]);
    }
    
    public function create(Request $request)
    {
        return $this->render_template('produk/create');

    }
    public function store(Request $request)
    {
        // $fileupload = $_FILES['fotoBerita'];
        
        $namaItem = $request->request->get('namaItem');
        $kuantiti = $request->request->get('kuantiti');
        $harga = $request->request->get('harga');
        $dateCreate = date('Y-m-d');
        $produkMasuk = $request->request->get('produkmasuk');
        $produkExpire = $request->request->get('produkexpire');

        $data_test = array(      
            'namaItem' => $namaItem,
            'kuantiti' => $kuantiti,
            'harga' => $harga,
            'dateCreate' => $dateCreate,
            'produkMasuk' => $produkMasuk,
            'produkExpire' => $produkExpire
        );

        
        $this->model->create($data_test);
        
      return new RedirectResponse('/produk');
    }
    public function ReadOne(Request $request)
    {
        $id = $request->attributes->get('id');
        $datas = $this->model->selectOne($id);
        

        return $this->render_template('produk/edit', ['datas'=>$datas]);
    }
    public function update(Request $request)
    {
        $id = $request->request->get('id');
        $namaItem = $request->request->get('namaItem');
        $kuantiti = $request->request->get('kuantiti');
        $harga = $request->request->get('harga');
        $produkMasuk = $request->request->get('produkmasuk');
        $produkExpire = $request->request->get('produkexpire');
        $id = $request->attributes->get('id');
        $data_test = array(
            'namaItem' => $namaItem,
            'kuantiti' => $kuantiti,
            'harga' => $harga,
            'produkMasuk' => $produkMasuk,
            'produkExpire' => $produkExpire
        );

        
       $this->model->update($id, $data_test);

       return new RedirectResponse('/produk');
    }
    public function delete(Request $request)
    {
        $id = $request->attributes->get('id');
        $this->model->delete($id);


        return new RedirectResponse('/produk');
    }
}