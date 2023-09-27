<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Background extends Model
{
    use HasFactory;
    protected $table = 'background';
    protected $fillable = [
            'name',
            'cover',
            'pembuka',
            'mempelai',
            'lovestory',
            'galeri',
            'videoprewed',
            'acara',
            'rsvp',
            'ucapan',
            'angpao',
            'livestreaming',
            'susunanacara',
            'penutup',
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
