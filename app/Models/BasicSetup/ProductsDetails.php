<?php

namespace App\Models\BasicSetup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsDetails extends Model
{
    use HasFactory;
    protected $table = 'product_details'; // Define table name

    protected $fillable = [
        'product_id', 
        'color', 
        'spec', 
        'image_path', 
        'status', 
        'create_by', 
        'create_date', 
        'update_by', 
        'update_date'
    ];

    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }


}
