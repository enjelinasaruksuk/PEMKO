<?php

namespace App\Http\Controllers\UnitLayanan;

use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    /**
     * Halaman Profile Unit Layanan.
     */
    public function index()
    {
        return view('pages.unit-layanan.profile.index');
    }


    /**
     * Halaman Perda & Perwali.
     */
    public function regulations()
    {
        return view('pages.unit-layanan.profile.regulations.index');
    }
}