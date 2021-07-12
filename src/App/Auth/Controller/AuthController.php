<?php

namespace App\Auth\Controller;

use Core\GlobalFunc;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class AuthController extends GlobalFunc
{
    public $session;

    public function __construct()
    {
        $this->session = new Session();
        $this->session->start();
    }
}
