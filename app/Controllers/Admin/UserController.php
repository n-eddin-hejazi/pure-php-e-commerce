<?php
namespace App\Controllers\Admin;
use App\Core\Support\QueryBuilder;
use Carbon\Carbon;

class UserController
{
    public function index()
    {
        return view('admin.users.index');
    }

    public function create()
    {
        return view('admin.users.create');
    }
}