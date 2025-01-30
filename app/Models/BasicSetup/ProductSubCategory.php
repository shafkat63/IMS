<?php

namespace App\Models\BasicSetup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSubCategory extends Model
{
    use HasFactory;

    protected $table = 'product_sub_categories';

    protected $fillable = [
        'name',
        'product_categories_id',
        'status',
        'create_by',
        'update_by'
    ];

    public $timestamps = false;
    
    public function productCategory()
    {
        return $this->belongsTo(Categories::class, 'product_categories_id');
    }
}
