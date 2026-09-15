<?php

namespace App\Mail;

use App\Models\Pengguna;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AkunDisetujuiMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Pengguna $pengguna, public string $passwordPlain)
    {
    }

    public function build()
    {
        return $this->subject('Akun Anda Telah Disetujui - ASAP')
            ->view('emails.akun_disetujui');
    }
}