<?php
namespace App\Controllers\Admin;

class HomeController
{
     public function index()
     {
          if_not_authenticated();
          return view('admin.home');
     }
     
}