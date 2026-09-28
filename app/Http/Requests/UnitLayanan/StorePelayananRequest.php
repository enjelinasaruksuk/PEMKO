<?php

namespace App\Http\Requests\UnitLayanan;

use Illuminate\Foundation\Http\FormRequest;

class StorePelayananRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_layanan' => ['required', 'string', 'max:255'],

            // Penyampaian Layanan
            'persyaratan' => ['nullable', 'string'],
            'sistem_mekanisme_prosedur' => ['nullable', 'string'],
            'jangka_waktu' => ['nullable', 'string'],
            'biaya' => ['nullable', 'string'],
            'produk_pelayanan' => ['nullable', 'string'],
            'penanganan_pengaduan' => ['nullable', 'string'],

            // Pengelolaan Pelayanan
            'dasar_hukum' => ['nullable', 'string'],
            'sarana_prasarana' => ['nullable', 'string'],
            'kompetensi_pelaksana' => ['nullable', 'string'],
            'pengawasan_internal' => ['nullable', 'string'],
            'jumlah_pelaksana' => ['nullable', 'string'],
            'jaminan_pelayanan' => ['nullable', 'string'],
            'jaminan_keamanan' => ['nullable', 'string'],
            'evaluasi_kinerja' => ['nullable', 'string'],
        ];
    }
}
