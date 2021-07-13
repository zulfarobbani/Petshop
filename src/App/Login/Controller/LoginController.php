<?php

namespace App\Login\Controller;

use App\Login\Model\Login;
use Core\GlobalFunc;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;

class LoginController extends GlobalFunc
{
    public $model;

    public function __construct()
    {
        $this->model = new Login();
        parent::beginSession();
    }

    public function index(Request $request)
    {
        $errors = $this->session->getFlashBag()->get('errors', []);

        return $this->render_template('login/index', ['errors' => $errors]);
    }

    public function login_proses(Request $request)
    {
        if (!is_null($request->request->get('login'))){
            $emailUser = $request->request->get('emailUser');
            $passwordUser = $request->request->get('passwordUser');

            $data = $this->model->selectOne($emailUser);

            if ($data != false){
                if (password_verify($passwordUser, $data['passwordUser'])){
                    $this->session->set('idUser', $data['idUser']);
                    $this->session->set('namaUser', $data['namaUser']);
                    $this->session->set('hirarkiUser', $data['hirarkiUser']);
                    $this->session->set('nikUser', $data['nikUser']);
                    $this->session->set('emailUser', $data['emailUser']);

                    return new RedirectResponse('/dashboard');
                } else {
                    $this->session->getFlashBag()->add('errors', 'Password salah!');

                    return new RedirectResponse('/login');
                }
            } else {
                $this->session->getFlashBag()->add('errors', 'Akun tidak ditemukan!');

                return new RedirectResponse('/login');
            }
        } else {
            return new RedirectResponse('/login');
        }
    }
}

?>