<?php

namespace App\Mail;

use App\Models\Pengguna;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordDiaturUlangMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Pengguna $pengguna, public string $passwordPlain) {}

    public function build(): static
    {
        return $this->subject('Password Akun ASAP Diatur Ulang')
            ->view('emails.password_diatur_ulang');
    }
}
