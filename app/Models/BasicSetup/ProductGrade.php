<?php

namespace App\Models\BasicSetup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductGrade extends Model
{
    use HasFactory;

    protected $table = 'product_grade';

    protected $fillable = [
        'name',
        'remarks',
        'status',
        'create_by',
        'update_by'
    ];

    public $timestamps = false;
}
