<?php
namespace App\Controllers\Admin;

class ProfileController
{

    public function __construct()
    {
        if_not_authenticated();    
    }

    public function show()
    {
        return view('admin.profile.show');
    }
     
}