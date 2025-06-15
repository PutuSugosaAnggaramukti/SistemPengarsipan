<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ViewPageController
{
    public function indexview()
    {
        return view('viewberkas.indexview');
    }
}
