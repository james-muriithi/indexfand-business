<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = 'order_items';

    public $timestamps = false;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'size',
        'color',
        'options'
    ];

    public function product()
    {
        $this->hasOne(Product::class, 'id','product_id');
    }

    public function order()
    {
        $this->belongsTo(Order::class, 'order_id');
    }
}
