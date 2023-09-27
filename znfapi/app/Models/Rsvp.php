<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Rsvp extends Model
{
    protected $table = 'rsvp';

    protected $fillable = ['nama', 'telepon', 'kehadiran','orderid'];


    public function order()
    {
        return $this->belongsTo(Order::class, 'orderid', 'id');
    }


}
