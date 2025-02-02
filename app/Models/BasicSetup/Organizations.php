<?php

namespace App\Models\BasicSetup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organizations extends Model
{
    use HasFactory;
    protected $table = 'organizations'; 
    public $timestamps = false; 

    protected $fillable = [
        'organization_logo',
        'organization_name',
        'tin_number',
        'bin_number',
        'vat_registration_number',
        'national_id',
        'address_1',
        'address_2',
        'contact_person_1',
        'contact_person_2',
        'contact_number_1',
        'contact_number_2',
        'email_address',
        'web_address',
        'mobile_wallet_number',
        'erc_number',
        'status',
        'create_by',
        'create_date',
        'update_by',
        'update_date',
    ];

}
