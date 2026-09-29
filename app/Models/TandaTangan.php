<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TandaTangan extends Model
{
    protected $table = 'tanda_tangan';
    protected $primaryKey = 'nip';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['nip', 'path'];
}