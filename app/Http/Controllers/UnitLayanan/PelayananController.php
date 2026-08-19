<?php

namespace App\Http\Controllers\UnitLayanan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PelayananController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $pelayananList = $request->session()->get(
            'pelayanan_list',
            []
        );

        return view(
            'pages.unit-layanan.pelayanan.index',
            compact('pelayananList')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view(
            'pages.unit-layanan.pelayanan.create'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $pelayananList = $request->session()->get(
            'pelayanan_list',
            []
        );

        $id = count($pelayananList) + 1;

        $data = $request->except('_token');

        $data['id'] = $id;

        $pelayananList[] = $data;

        $request->session()->put(
            'pelayanan_list',
            $pelayananList
        );

        return redirect()
            ->route('unit_layanan.pelayanan.index')
            ->with(
                'success',
                'Data pelayanan berhasil ditambahkan.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    public function edit(
        Request $request,
        int $pelayanan
    ) {
        $pelayananList = $request->session()->get(
            'pelayanan_list',
            []
        );

        $data = collect($pelayananList)
            ->firstWhere(
                'id',
                $pelayanan
            );

        if (!$data) {

            return redirect()
                ->route('unit_layanan.pelayanan.index')
                ->with(
                    'error',
                    'Data pelayanan tidak ditemukan.'
                );
        }

        $data = (object) $data;

        return view(
            'pages.unit-layanan.pelayanan.edit',
            compact('data')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        int $pelayanan
    ) {
        $pelayananList = $request->session()->get(
            'pelayanan_list',
            []
        );

        foreach ($pelayananList as $index => $item) {

            if ((int) $item['id'] === $pelayanan) {

                $data = $request->except(
                    '_token',
                    '_method'
                );

                $data['id'] = $item['id'];

                $pelayananList[$index] = $data;

                break;
            }
        }

        $request->session()->put(
            'pelayanan_list',
            $pelayananList
        );

        return redirect()
            ->route('unit_layanan.pelayanan.index')
            ->with(
                'success',
                'Data pelayanan berhasil diperbarui.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | DESTROY
    |--------------------------------------------------------------------------
    */

    public function destroy(
        Request $request,
        int $pelayanan
    ) {
        $pelayananList = $request->session()->get(
            'pelayanan_list',
            []
        );

        $pelayananList = collect($pelayananList)
            ->reject(function ($item) use ($pelayanan) {

                return (int) $item['id'] === $pelayanan;

            })
            ->values()
            ->all();

        $request->session()->put(
            'pelayanan_list',
            $pelayananList
        );

        return redirect()
            ->route('unit_layanan.pelayanan.index')
            ->with(
                'success',
                'Data pelayanan berhasil dihapus.'
            );
    }
}