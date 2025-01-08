<?php

class Home extends Controller
{
    public function __construct()
    {
        Middleware::Auth();
    }

    public function index()
    {
        $data['title'] = 'Home';
        $this->view('templates/header', $data);

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->view('templates/sidebar');
        $this->view('templates/navbar');
        $this->view('Home/index');
        $this->view('templates/footer');
    }
}
