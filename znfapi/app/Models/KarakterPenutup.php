<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KarakterPenutup extends Model
{
    use HasFactory;
    protected $table = 'karakterpenutup';

    protected $fillable = ['name', 'karakter_id', 'image'];
    public function karakter()
    {
        return $this->belongsTo(Karakter::class);
    }
}