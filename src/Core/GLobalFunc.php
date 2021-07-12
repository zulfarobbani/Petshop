<?php

namespace Core;

use Config\Database;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class GlobalFunc
{
    public $conn;
    public $baseUrl;
    public $session;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->conn;
        $this->baseUrl = 'http://crt-framework.com/';
    }

    public function beginSession()
    {
        $this->session = new Session();
        $this->session->start();
    }

    public function render_template($page, $data = [], $request = null)
    {
        if (!is_null($request)) {
            extract($request->attributes->all(), EXTR_SKIP);
        }
        extract($data, EXTR_SKIP);

        // ** fungsi panggil asset **
        $assets = function ($pathFile) {
            return $this->baseUrl.'assets/'.$pathFile;
        };

        ob_start();
        include sprintf(__DIR__.'/../../src/pages/%s.php', $page);

        return new Response(ob_get_clean());
    }

    public function assets(Request $request)
    {
        $extension = $request->attributes->get('_format');
        $file = $request->attributes->get('path').'.'.$extension;
        $pathFile = __DIR__.'/../../src/assets/'.$file;
        
        if (!file_exists($pathFile)) {
            $response = new Response("File Not Found!");
            $response->headers->set('Content-Type', 'text/plain');
            return $response;
        }

        ob_start();
        include $pathFile;

        $response = new Response(ob_get_clean());

        $content_type = '';
        if ($extension == 'css') {
            $content_type = 'text/css';
        } else if ($extension == 'js') {
            $content_type = 'text/script';
        }

        $response->headers->set('Content-Type', $content_type);
        return $response;
    }

    public function esc_str($conn, $data)
    {
        return pg_escape_string($conn, $data);
    }
}
