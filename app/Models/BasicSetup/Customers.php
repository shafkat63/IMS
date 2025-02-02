<?php

namespace App\Models\BasicSetup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    use HasFactory;
    protected $table = 'customers';

    protected $fillable = [
        'name',
        'country_name',
        'address',
        'mobile_number',
        'email',
        'bin_number',
        'tin_number',
        'vat_registration_number',
        'national_id',
        'irc_number',
        'remarks',
        'status',
        'create_by',
        'create_date',
        'update_by',
        'update_date',
    ];


    public $timestamps = false;
}
