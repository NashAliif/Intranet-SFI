<?php

class Error404 extends Controller
{
    public function index()
    {
        $data['title'] = 'Error404';
        $this->view('templates/header', $data);
        $this->view('error/index');
        // $this->view('templates/footer');
    }
}