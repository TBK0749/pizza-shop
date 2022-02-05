<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = 'order_items';
    protected $fillable = [
        'order_id',
        'pizza_id',
        'qty',
        'price',
    ];

    public function pizzas()
    {
        return $this->belongsTo(Pizza::class, 'pizza_id', 'id');
    }
}
