<?php

class Controller
{
    public function view($view, $data = [])
    {
        include_once '../Intranet/app/views/' . $view . '.php';
    }
}
