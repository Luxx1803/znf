<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Musik extends Model
{
    use HasFactory;
    protected $table = 'musik';

    protected $fillable = ['name', 'musik', 'kategori'];


}
