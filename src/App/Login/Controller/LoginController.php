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
    public $idUser;
    public $namaUser;
    public $hirarkiUser;
    public $nikUser;
    public $emailUser;

    public function __construct()
    {
        $this->model = new Login();
        parent::beginSession();
        $this->idUser = $this->session->get('idUser');
        $this->namaUser = $this->session->get('namaUser');
        $this->hirarkiUser = $this->session->get('hirarkiUser');
        $this->nikUser = $this->session->get('nikUser');
        $this->emailUser = $this->session->get('emailUser');
    }

    public function index(Request $request)
    {
        if ($this->emailUser != null){
            return new RedirectResponse('/login');
        }

        $errors = $this->session->getFlashBag()->get('errors', []);

        return $this->render_template('login/login', ['errors' => $errors]);
    }

    public function login_proses(Request $request)
    {
        if (!is_null($request->request->get('login'))){
            $emailUser = $request->request->get('emailUser');
            $passwordUser = $request->request->get('passwordUser');

            $data = $this->model->selectOne($emailUser);
            // $this->dd($data);

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

    public function logout_proses(Request $request)
    {
        $this->session->invalidate();
        return new RedirectResponse('/login');
    }
}

?>