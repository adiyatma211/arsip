<?php

namespace App\Http\Controllers;

use App\Models\NasabahAktif;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function Dashboard()
    {
        return view('Dashboard.v_dash');
    }

    public function ManageAktif()
    {
        $getDataAktif= NasabahAktif::all();
        return view('ManajemenAktif.v_manageAktif',compact('getDataAktif'));
    }
    public function ManageLunas()
    {
        return view('ManajemenLunas.v_manageLunas');
    }
    public function ManageMusnah()
    {
        return view('ManajemenMusnah.v_manageMusnah');
    }
    public function PinjamDokumen()
    {
        return view('ManajemenPinjam.v_pinjam');
    }

}
