<?php

namespace App\Http\Requests\UnitLayanan;

class UpdatePelayananRequest extends StorePelayananRequest
{
    // Update mengikuti aturan validasi yang sama dengan Store.
    // Dipisah sebagai kelas sendiri supaya aturan bisa dibedakan
    // di masa depan tanpa mengubah kontrak StorePelayananRequest.
}
