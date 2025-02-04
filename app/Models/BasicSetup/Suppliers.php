<?php

namespace App\Models\BasicSetup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suppliers extends Model
{
    use HasFactory;
    protected $table = 'suppliers'; 


    public $timestamps = false;

    protected $fillable = [
        'supplier_name',
        'country_name',
        'address1',
        'address2',
        'city',
        'email',
        'contact_number',
        'remarks',
        'status',
        'create_by',
        'create_date',
        'update_by',
        'update_date',
    ];
}
