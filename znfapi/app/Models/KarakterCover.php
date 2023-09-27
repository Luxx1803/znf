<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KarakterCover extends Model
{
    use HasFactory;
    protected $table = 'karaktercover';

    protected $fillable = ['name', 'karakter_id', 'image'];
    public function karakter()
    {
        return $this->belongsTo(Karakter::class);
    }
}