<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pembayaran extends Model
{
    use HasFactory;
    protected $table = 'pembayarans';

    protected $fillable = [
       'username',
       'userid',
       'nominal',
       'bukti_transfer',
       'tanggal_bayar',
       'status',
       'paket',
       'noreff',
       'jenis',

    ];

}
