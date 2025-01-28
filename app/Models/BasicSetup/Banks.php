<?php

namespace App\Models\BasicSetup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banks extends Model
{
    use HasFactory;
    protected $table = 'banks';
    protected $fillable = [
        'bank_name',
        'bin_number',
        'tin_number',
        'status',
        'created_by',
        'updated_by',
    ];

    public $timestamps = false;
}
