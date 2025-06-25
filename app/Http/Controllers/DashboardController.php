<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController
{
    public function index()
    {
        return view('dashboard.index'); // Blade file at resources/views/dashboard/index.blade.php
    }
}
