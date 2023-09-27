<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'tema_id',
        'status',
        'jenis',
        'paket',
        'template',
        'kode',

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
        'user_id',
        'fotodepan',

        'background_id',
        'warna_id',
        'karakter_id',
        'font_id',
        'elemen_id'

    ];


    protected $with = ['tema'];
    public function tema()
    {
        return $this->belongsTo(Tema::class, 'tema_id', 'id');
    }
    public function background()
    {
        return $this->hasMany(Background::class, 'produk_id', 'id');
    }
    public function warna()
    {
        return $this->hasMany(Warna::class, 'produk_id', 'id');
    }
    public function elemen()
    {
        return $this->hasMany(Elemen::class, 'produk_id', 'id');
    }
    public function karakter()
    {
        return $this->hasMany(Karakter::class, 'produk_id', 'id');
    }
    public function font()
    {
        return $this->hasMany(Karakter::class, 'produk_id', 'id');
    }


}