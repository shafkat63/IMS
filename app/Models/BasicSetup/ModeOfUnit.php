<?php

namespace App\Models\BasicSetup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModeOfUnit extends Model
{
    use HasFactory;
    protected $table = 'mode_of_units';

    protected $fillable = [
        'unit_name',
        'status',
        'create_by',
        'create_date',
        'update_by',
        'update_date',
    ];

    public $timestamps = false; 
}
