<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Font extends Model
{
    use HasFactory;
    protected $table = 'font';
    protected $fillable = [
        'name',
        'font',
        'cover',
        'primaryfont',
        'secondaryfont',
        'regularfont',
        'titlefont',

    ];
    public function product()
    {
        return $this->belongsTo(Product::class, 'produk_id', 'id');
    }
    public function order()
    {
        return $this->belongsTo(Order::class, 'orderid', 'id');
    }


}
