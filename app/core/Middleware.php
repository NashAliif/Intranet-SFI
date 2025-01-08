<?php

abstract class Middleware
{
    public static function Auth()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASEURL . '/auth');
        }
    }

    public static function unAuth()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['user_id'])) {
            header('Location: ' . BASEURL);
        }
    }
}
