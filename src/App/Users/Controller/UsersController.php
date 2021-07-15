<?php

namespace App\Users\Controller;

use App\Media\Model\Media;
use App\Users\Model\Users;
use Core\GlobalFunc;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;

class UsersController extends GlobalFunc
{
    public $model;

    public function __construct()
    {
        $this->model = new Users();
        parent::beginSession();
    }

    public function index(Request $request)
    {
        $datas = $this->model->selectAll();

        return $this->render_template('users/users', ['datas' => $datas]);
    }

    public function create(Request $request)
    {
        return $this->render_template('users/create');
    }

    public function store(Request $request)
    {
        $idUser = uniqid('user');

        $namaUser = $request->request->get('namaUser');
        $nohpUser = $request->request->get('nohpUser');
        $hirarkiUser = $request->request->get('hirarkiUser');
        $dateCreate = date("Y-m-d");
        $emailUser = $request->request->get('emailUser');
        $passwordUser = password_hash('123', PASSWORD_DEFAULT);

        $user_arr = array(
            "idUsers" => $idUser,
            "namaUser" => $namaUser,
            "nohpUser" => $nohpUser,
            "passwordUser" => $passwordUser,
            "hirarkiUser" => $hirarkiUser,
            'emailUser' => $emailUser
        );

        $user = $this->model->create($user_arr);

        // store foto produk
        if ($_FILES['fotoUser']['name'] != '') {
            $media = new Media();
            $idMedia = uniqid('med');
            $idUser = '1';
            $fotoUser = $media->create($idMedia, $_FILES['fotoUser'], $user, $idUser);
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
        $nohpUser = $request->request->get('nohpUser');
        $hirarkiUser = $request->request->get('hirarkiUser');
        $emailUser = $request->request->get('emailUser');
        $passwordUser = password_hash('123', PASSWORD_DEFAULT);

        $user_arr = array(
            "namaUser" => $namaUser,
            "nohpUser" => $nohpUser,
            "passwordUser" => $passwordUser,
            "hirarkiUser" => !is_null($hirarkiUser) ? $hirarkiUser : $detail['hirarkiUser'],
            'emailUser' => $emailUser
        );

        $user = $this->model->update($id_user, $user_arr);

        if ($_FILES['fotoUser']['name'] != '') {
            $media = new Media();
            // select existing foto user
            $selectUser = $media->selectOneMedia("idRelation = '$id_user'");
            // delete existing foto user
            $deleteFotoUser = $media->delete($selectUser['idMedia']);
            // delete file foto user
            $deleteFileFotoUser = $media->deleteFile($selectUser['pathMedia']);

            $idMedia = uniqid('med');
            $idUser = '1';
            $FotoUser = $media->create($idMedia, $_FILES['fotoUser'], $user, $idUser);
        }

        $redirect = !is_null($hirarkiUser) ? '/users' : '/profile';
        return new RedirectResponse($redirect);
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

    public function get(Request $request)
    {
        $id_user = $request->attributes->get('id_user');
        $detail = $this->model->selectOne($id_user);

        return new JsonResponse(['detail' => $detail]);
    }

    public function reset_password(Request $request)
    {
        $id_user = $request->attributes->get('id_user');
        $this->model->resetPassword($id_user);

        return new RedirectResponse('/users');
    }

    public function profile(Request $request)
    {
        $id_user = 'user60eefe5a7a23d';
        $user = $this->model->selectOne($id_user);

        return $this->render_template('users/profile', ['user' => $user]);
    }

    public function akun(Request $request)
    {
        $id_user = 'user60eefe5a7a23d';
        $user = $this->model->selectOne($id_user);
        $errors = $this->session->getFlashBag()->get('errors', []);

        return $this->render_template('users/akun', ['user' => $user, 'errors' => $errors]);
    }

    public function akun_update(Request $request)
    {
        $id_user = $request->attributes->get('id_user');
        $user = $this->model->selectOne($id_user);
        $passwordLama = $request->request->get('passwordLama');
        $passwordBaru = $request->request->get('passwordBaru');
        $passwordKonfirmasiBaru = $request->request->get('passwordKonfirmasiBaru');

        if (password_verify($passwordLama, $user['passwordUser'])) {
            if ($passwordBaru == $passwordKonfirmasiBaru) {
                $this->model->updatePassword($id_user, $passwordBaru);
            } else {
                $this->session->getFlashBag()->add('errors', 'Konfirmasi password baru tidak sesuai!');
            }
        } else {
            $this->session->getFlashBag()->add('errors', 'Password lama salah!');
        }

        return new RedirectResponse('/akun');
    }
}
