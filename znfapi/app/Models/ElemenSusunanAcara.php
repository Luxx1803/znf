<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElemenSusunanAcara extends Model
{
    use HasFactory;
    protected $table = 'elemensusunanacara';

    protected $fillable = ['name', 'elemen_id', 'image'];
    public function elemen()
    {
        return $this->belongsTo(Elemen::class);
    }
}
