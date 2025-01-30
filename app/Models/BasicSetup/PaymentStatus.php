<?php

namespace App\Models\BasicSetup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentStatus extends Model
{
    use HasFactory;
    protected $table = 'payment_status';

    protected $fillable = [
        'name',
        'status',
        'create_by',
        'update_by'
    ];

    public $timestamps = false;
    

}
