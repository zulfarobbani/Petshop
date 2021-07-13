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

        return $this->render_template('users/index', ['datas' => $datas]);
    }

    public function create(Request $request)
    {
        return $this->render_template('transaksi/create');
    }

    public function store(Request $request)
    {
        $idUser = uniqid('user');

        $namaUser = $request->request->get('namaUser');
        $passwordUser = $request->request->get('passwordUser');
        $confirmPasswordUser = $request->request->get('confirmPasswordUser');
        $nikUser = $request->request->get('nikUser');
        $hirarkiUser = $request->request->get('hirarkiUser');
        $dateCreate = date("Y-m-d");

        if ($passwordUser != $confirmPasswordUser)
        {
            return new JsonResponse("Password Dan Confirm Password Tidak Sesuai");
        } else 
        {
            $user_arr = array(
                "idUsers" => $idUser,
                "namaUsers" => $namaUser,
                "passwordUser" => password_hash($passwordUser, PASSWORD_DEFAULT),
                "nikUser" => $nikUser,
                "hirarkiUser" => $hirarkiUser,
                "dateCreate" => $dateCreate
            );
    
            $create = $this->model->create($user_arr);
        }

        return new RedirectResponse('/users');
    }

    public function edit(Request $request)
    {
        $id_user = $request->attributes->get('id_user');

        $detail = $this->model->selectOne($id_user);

        return $this->render_template('users/edit', ['detail' => $detail]);
    }

    public function update(Request $request)
    {
        $id_user = $request->attributes->get('id_user');

        $detail = $this->model->selectOne($id_user);
        
        $namaUser = $request->request->get('namaUser');
        $currentPasswordUser = $request->request->get('currentPasswordUser');
        $passwordUser = $request->request->get('passwordUser');
        $confirmPasswordUser = $request->request->get('confirmPasswordUser');
        $nikUser = $request->request->get('nikUser');
        $hirarkiUser = $request->request->get('hirarkiUser');

        if (!password_verify($currentPasswordUser, $detail['passwordUser'])){

            return new JsonResponse("Current Password Salah Atau Tidak Sesuai");

        } else {
            if ($passwordUser != $confirmPasswordUser){
                return new JsonResponse("Password Dan Confirm Password Tidak Sesuai");
            } else {
                $user_arr = array(
                    "namaUsers" => $namaUser,
                    "passwordUser" => password_hash($passwordUser, PASSWORD_DEFAULT),
                    "nikUser" => $nikUser,
                    "hirarkiUser" => $hirarkiUser
                );
        
                $update = $this->model->update($id_user, $user_arr);
            }
        }

        return new RedirectResponse('/users');
        
    }

    public function detail(Request $request)
    {
        $id_user = $request->attributes->get('id_user');
        
        $detail = $this->model->selectOne($id_user);

        return $this->render_template('users/detail', ['detail' => $detail]);

    }

    public function delete(Request $request)
    {
        $id_user = $request->attributes->get('id_user');

        $delete = $this->model->delete($id_user);

        return new RedirectResponse('/users');
    }
}
