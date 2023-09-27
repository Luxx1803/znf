<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karakter extends Model
{
    use HasFactory;
    protected $table = 'karakter';
    protected $fillable = [
        'name',
        'image',
    ];



    public function karaktercover()
    {
        return $this->hasMany(KarakterCover::class);
    }
    public function karaktermempelai()
    {
        return $this->hasMany(KarakterMempelai::class);
    }
    public function karakterangpao()
    {
        return $this->hasMany(KarakterAngpao::class);
    }
    public function karakterlovestory()
    {
        return $this->hasMany(KarakterLovestory::class);
    }
    public function karakterpenutup()
    {
        return $this->hasMany(KarakterPenutup::class);
    }




}