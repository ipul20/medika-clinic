<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Helper;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->title = 'dashboard';
//        $this->middleware("roles:{$this->title}");
    }

    public function index()
    {
        return view('admin.dashboard');
    }
}
