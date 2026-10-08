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
        'nama_layanan' => 'required|string|max:255',
        'komponen' => 'nullable|array',
        'komponen.*' => 'nullable|string',
    ];
}
}
