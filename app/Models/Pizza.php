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

    protected $table = 'pizzas';
    protected $fillable = [
        'name',
        'price',
        'image',
    ];

    // Relationship
    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class);
    }

    public function deleteImage()
    {
        // Delete the old image
        $imagePath = str_replace("/", "\\", $this->image);
        $oldImageFullPath = public_path($imagePath);

        // /user/pond/code/laravel/pizza-shop/public/images/pizzas/asdqwdqwd.png
        if (file_exists($oldImageFullPath)) {
            unlink($oldImageFullPath);
        }
    }
}
