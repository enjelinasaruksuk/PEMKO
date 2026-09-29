<?php

namespace App\Http\Controllers\UnitLayanan;

use App\Http\Controllers\Controller;
use App\Models\Maklumat;
use App\Traits\ResolvesInstansiId;

class MaklumatController extends Controller
{
    use ResolvesInstansiId;

    public function index()
    {
        $maklumatList = Maklumat::where('id_instansi', $this->currentInduknyaInstansiId())
            ->where('status', 'disetujui')
            ->latest()
            ->get();

        return view('pages.unit-layanan.maklumat.index', compact('maklumatList'));
    }
}
