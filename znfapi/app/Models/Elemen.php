<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Elemen extends Model
{
    use HasFactory;
    protected $table = 'elemen';
    protected $fillable = [
        'name',
        'image',
    ];



    public function elemencover()
    {
        return $this->hasMany(ElemenCover::class);
    }
    public function elemenpembuka()
    {
        return $this->hasMany(ElemenPembuka::class);
    }
    public function elemenacara()
    {
        return $this->hasMany(ElemenAcara::class);
    }
    public function elemengaleri()
    {
        return $this->hasMany(ElemenGaleri::class);
    }
    public function elemenlivestream()
    {
        return $this->hasMany(ElemenLiveStream::class);
    }
    public function elemenlovestory()
    {
        return $this->hasMany(ElemenLovestory::class);
    }
    public function elemenmempelai()
    {
        return $this->hasMany(ElemenMempelai::class);
    }
    public function elemenrsvp()
    {
        return $this->hasMany(ElemenRsvp::class);
    }
    public function elemenpenutup()
    {
        return $this->hasMany(ElemenPenutup::class);
    }
    public function elemensusunanacara()
    {
        return $this->hasMany(ElemenSusunanAcara::class);
    }
    public function elemenucapan()
    {
        return $this->hasMany(ElemenUcapan::class);
    }
    public function elemenvideoprewed()
    {
        return $this->hasMany(ElemenVideoprewed::class);
    }
    public function elemenangpao()
    {
        return $this->hasMany(ElemenAngpao::class);
    }


}