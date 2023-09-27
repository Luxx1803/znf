<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElemenVideoprewed extends Model
{
    use HasFactory;
    protected $table = 'elemenvideoprewed';

    protected $fillable = ['name', 'elemen_id', 'image'];
    public function elemen()
    {
        return $this->belongsTo(Elemen::class);
    }
}
