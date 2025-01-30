<?php

namespace App\Models\BasicSetup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    protected $table = 'categories';

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
