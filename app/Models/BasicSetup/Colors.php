<?php

namespace App\Models\BasicSetup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colors extends Model
{
    use HasFactory;

    protected $table = 'colors';

    protected $fillable = [
        'name',
        'status',
        'create_by',
        'create_date',
        'update_by',
        'update_date',
    ];

    public $timestamps = false; 
}
