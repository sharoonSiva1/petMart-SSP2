<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'address',
        'city',
        'phone',
        'payment_method',
        'total',
        'status',
        'cancelled_by',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Recalculate total logic.
     */
    public function recalculateTotal()
    {
        $this->total = $this->items->sum(function ($item) {
            return $item->price * $item->quantity;
        });
        $this->save();
    }
}
