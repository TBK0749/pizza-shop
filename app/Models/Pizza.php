<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Pizza -> pizzas
// OrderPayment -> order_payments
// order_p
// Magic
class Pizza extends Model
{
    use HasFactory;

    // protected $table = 'order_p';
    protected $fillable = [
        'name',
        'pizza_image',
    ];

    // Relationship
    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class);
    }
}
