<?php

namespace App\Models\BasicSetup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipmentMode extends Model
{
    use HasFactory;
    protected $table = 'shipment_mode';
    protected $fillable = [
        'name',
        'status',
        'create_by',
        'create_date',
        'update_by',
        'update_date'
    ];
    public $timestamps = false;
}
