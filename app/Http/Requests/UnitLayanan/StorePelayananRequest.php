<?php

namespace App\Http\Requests\UnitLayanan;

use App\Models\KomponenPelayanan;
use Illuminate\Foundation\Http\FormRequest;

class StorePelayananRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'nama_layanan' => 'required|string|max:255',
            'komponen' => 'required|array',
        ];

        foreach (KomponenPelayanan::pluck('id_komponen') as $id) {
            $rules["komponen.$id"] = [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    // Quill mengirim "<p><br></p>" saat kosong
                    if (trim(strip_tags(html_entity_decode((string) $value))) === '') {
                        $fail('Komponen :attribute wajib diisi.');
                    }
                },
            ];
        }

        return $rules;
    }

    public function attributes(): array
    {
        $attributes = [];

        foreach (KomponenPelayanan::all() as $komponen) {
            $attributes["komponen.{$komponen->id_komponen}"] = $komponen->nama_komponen;
        }

        return $attributes;
    }

    public function messages(): array
    {
        return [
            'nama_layanan.required' => 'Nama layanan wajib diisi.',
            'komponen.required' => 'Semua komponen layanan wajib diisi.',
            'komponen.*.required' => 'Komponen :attribute wajib diisi.',
        ];
    }
}