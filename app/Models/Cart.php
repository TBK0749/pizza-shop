<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts';

    protected $fillable = [
        'user_id',
        'pizza_id',
        'pizza_qty',
    ];

    public function pizzas()
    {
        return $this->belongsTo(Pizza::class, 'pizza_id', 'id');
    }
}
