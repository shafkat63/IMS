<?php

namespace App\Models\BasicSetup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankBranch extends Model
{
    use HasFactory;
    protected $table = 'bank_branches'; 

    public $timestamps = false; 

    protected $fillable = [
        'bank_name',
        'routing_number',
        'swift_code',
        'branch_name',
        'contact_number',
        'contact_person_name',
        'email',
        'status',
        'create_by',
        'create_at',
        'update_by',
        'update_at'
    ];
}
