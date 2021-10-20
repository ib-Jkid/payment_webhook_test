<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "reference",
        "payment_gateway",
        "total_amount",
        "gateway_charges",
        "status",
        "paid_on",
        "actual_gateway_charges",
        "actual_amount_paid",
        "currency"
    ];



    public function user() {
        return $this->belongsTo(User::class,"user_id");
    }
}
