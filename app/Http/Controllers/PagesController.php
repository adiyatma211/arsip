<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function Dashboard()  
    {
        return view('Dashboard.v_dash');
    }

    public function ManageAktif() 
    {
        return view('ManajemenAktif.v_manageAktif');
    }
}
