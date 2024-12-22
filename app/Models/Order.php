<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Order extends Model
{
    protected $fillable = [
        "qty",
        "total",
        "delivered_at",
        "pelanggan_id",
        "coupon_id"
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }

    public function getDeliveredAtAttribute($value)
    {
        if ($value) {
            return Carbon::parse($value)->diffForHumans();
        } else {
            return null;
        }
    }
}
