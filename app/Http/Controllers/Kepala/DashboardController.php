<?php

namespace App\Http\Controllers\Kepala;

use App\Http\Controllers\Controller;


class DashboardController extends Controller
{
    public function index()
    {
        return view('pages.kepala.dashboard.index');
    }
}
