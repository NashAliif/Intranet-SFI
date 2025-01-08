<?php

class Auth extends Controller
{
    public function __construct()
    {
        Middleware::unAuth();
    }

    public function index()
    {
        $data['title'] = 'Login';

        $this->view('templates/header', $data);
        $this->view('auth/index');
        // $this->view('templates/footer', $data);
    }

    public function login()
    {
        $logedIn = AuthModel::login($_POST);

        if ($logedIn) {
            header('Location: ' . BASEURL);
        } else {
            header('Location: ' . BASEURL . '/auth');
        }
    }

    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        session_destroy();

        header('Location: ' . BASEURL . '/auth');
    }
}
