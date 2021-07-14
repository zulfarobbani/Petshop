<?php

namespace App\Dashboard\Controller;

use App\Dashboard\Model\Dashboard;
use Core\GlobalFunc;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;

class DashboardController extends GlobalFunc
{
    public $model;

    public function __construct()
    {
        $this->model = new Dashboard();
    }

    public function index(Request $request)
    {
        return $this->render_template('dashboard/index');
    }

}
