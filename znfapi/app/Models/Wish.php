<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Wish extends Model
{
    use HasFactory;
    protected $table = 'wishe';
    protected $fillable = ['name', 'ucapan', 'orderid'];

    public function order()
    {
        return $this->belongsTo(Order::class, 'orderid', 'id');
    }



}
