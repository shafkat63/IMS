<?php

namespace App\Models\BasicSetup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    use HasFactory;
    protected $table = 'product_type';

    protected $fillable = [
        'name',
        'alias',
        'status',
        'create_by',
        'update_by'
    ];

    public $timestamps = false;
}
