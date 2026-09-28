<?php

namespace App\Http\Requests\UnitLayanan;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSkRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'no_sk' => ['required', 'string', 'max:255'],
            'tanggal_sk' => ['required', 'date'],
            'jenis_sk' => ['required', Rule::in(['SK Baru', 'Menggantikan SK Sebelumnya'])],
            'no_sk_sebelumnya' => [
                Rule::requiredIf(fn () => $this->input('jenis_sk') === 'Menggantikan SK Sebelumnya'),
                'nullable',
                'string',
                'max:255',
            ],
        ];
    }

    /**
     * Bersihkan no_sk_sebelumnya jika jenis SK tidak membutuhkannya,
     * supaya data yang tersimpan selalu konsisten.
     */
    protected function passedValidation(): void
    {
        if ($this->input('jenis_sk') !== 'Menggantikan SK Sebelumnya') {
            $this->merge(['no_sk_sebelumnya' => null]);
        }
    }
}
