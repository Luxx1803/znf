<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warna extends Model
{
    use HasFactory;
    protected $table = 'warna';
    protected $fillable = [
   'name',
   'warnateks',
   'warnatexticon',
   'warnabutton',
   'warnabackground',

    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'produk_id', 'id');
    }
    public function order()
    {
        return $this->belongsTo(Order::class, 'orderid', 'id');
    }
}
