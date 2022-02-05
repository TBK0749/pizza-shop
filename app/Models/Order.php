<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'address_1',
        'address_2',
        'city',
        'state',
        'country',
        'pin_code',
        'status',
        'message',
        'tracking_no',
        'total_price',
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
