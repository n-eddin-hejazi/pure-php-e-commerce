<?php

namespace App\Controllers\Auth;
class LogoutController
{
    public function index()
    {
        session_start();
        $_SESSION['loggedin'] = FALSE;
        unset($_SESSION['loggedin']);
        unset($_SESSION['id']);
        session_unset();
        session_destroy();
        if(isset($_COOKIE['remember_me'])){
            setcookie('remember_me', "", time() - (60 * 60 * 24 * 30), '/');
        }
        return to('');
    }

}