<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaystackLog extends Model
{
    use HasFactory;

    protected $fillable = [
        "reference",
        "status",
        "payload",
        "error"
    ];
}
