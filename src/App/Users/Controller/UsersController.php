<?php

namespace App\Users\Controller;

use App\Chronology\Model\Chronology;
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
    }

    public function index(Request $request)
    {
        $datas = $this->model->selectAll();

        return $this->render_template('users/index', ['datas' => $datas]);
    }

    public function create(Request $request)
    {
        return $this->render_template('users/create');
    }

    public function store(Request $request)
    {
        $passwordUser = $request->request->get('passwordUser');
        $confirmPasswordUser = $request->request->get('confirmPasswordUser');

        if ($passwordUser != $confirmPasswordUser)
        {
            return new JsonResponse("Password Dan Confirm Password Tidak Sesuai");
        } else 
        {
            $create = $this->model->create($request->request);
        }

        // create chronlogy
        $chronology = new Chronology();
        $message = $this->model->chronologyMessage('store', 'User 1', [
            'user' => $request->request->get('namaUser')
        ]);
        $createChronology = $chronology->create($message, $create);

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

        $currentPasswordUser = $request->request->get('currentPasswordUser');
        $passwordUser = $request->request->get('passwordUser');
        $confirmPasswordUser = $request->request->get('confirmPasswordUser');

        if (!password_verify($currentPasswordUser, $detail['passwordUser'])){

            return new JsonResponse("Current Password Salah Atau Tidak Sesuai");

        } else {
            if ($passwordUser != $confirmPasswordUser){
                return new JsonResponse("Password Dan Confirm Password Tidak Sesuai");
            } else {     
                $update = $this->model->update($id_user, $request->request);
            }
        }

        // create chronlogy
        $chronology = new Chronology();
        $message = $this->model->chronologyMessage('update', 'User 1', [
            'user' => $detail['namaUser']
        ]);
        $createChronology = $chronology->create($message, $id_user);

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
        $detail = $this->model->selectOne($id_user);

        $delete = $this->model->delete($id_user);
        
        // create chronlogy
        $chronology = new Chronology();
        $message = $this->model->chronologyMessage('delete', 'User 1', [
            'user' => $detail['namaUser']
        ]);
        $createChronology = $chronology->create($message, $id_user);

        return new RedirectResponse('/users');
    }
}
