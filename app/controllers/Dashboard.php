<?php

class Dashboard extends Controller
{
    public function __construct()
    {
        Middleware::Auth();
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['dailyPresent'] = DashboardModel::getDailyPresent();
        $this->view('templates/header', $data);

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        

        // var_dump($data);
        $this->view('templates/sidebar');
        $this->view('templates/navbar');
        $this->view('Dashboard/index', $data);
        $this->view('templates/footer');
    }
}
