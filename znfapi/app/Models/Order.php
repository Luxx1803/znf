<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tema;
use App\Models\User;


class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = [
        'jenis',
        'name',
        'masaaktif',
        'noref',
        'fotopria',
        'fotowanita',
        'namelwanita',
        'namelpria',
        'namewanita',
        'namepria',
        'nameotpria',
        'nameotwanita',
        'igpria',
        'igwanita',
        'lovestory',
        'tglacara',
        'tglakad',
        'jamakad',
        'tempatakad',
        'alamatakad',
        'linkgmapsakad',
        'tglresepsi',
        'jamresepsi',
        'tempatresepsi',
        'alamatresepsi',
        'linkgmapsresepsi',
        'galeri',
        'linkvideoprewed',
        'jamlive',
        'linkliveyt',
        'linkliveig',
        'linklivetiktok',
        'fotocover',
        'fotolovestory',
        'fotorsvp',
        'fotopenutup',
        'namabank1',
        'norek1',
        'an1',
        'namabank2',
        'norek2',
        'an2',
        'status',
        'user_id',
        'tema_id',
        'paket',
        'harga',
    ];



    protected $with = ['tema'];

    public function tema()
    {
        return $this->belongsTo(Tema::class, 'tema_id', 'id');
    }

    public function wishes()
    {
        return $this->hasMany(Wish::class, 'orderid', 'id');
    }

    public function background()
    {
        return $this->hasMany(Background::class, 'order_id', 'id');
    }
    public function warna()
    {
        return $this->hasMany(Warna::class, 'order_id', 'id');
    }
    public function elemen()
    {
        return $this->hasMany(Elemen::class, 'order_id', 'id');
    }
    public function karakter()
    {
        return $this->hasMany(Karakter::class, 'order_id', 'id');
    }
    public function font()
    {
        return $this->hasMany(Karakter::class, 'order_id', 'id');
    }


}
