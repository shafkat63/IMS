<?php

namespace App\Models\BasicSetup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $table = 'products'; 

    protected $primaryKey = 'id'; 

    public $timestamps = false; 

    protected $fillable = [
        'product_name',
        'product_type',
        'product_category_id',
        'sub_category_id',
        'mode_of_unit',
        'part_number',
        'import_hs_code',
        'export_hs_code',
        'product_grade',
        'status',
        'create_by',
        'create_date',
        'update_by',
        'update_date',
    ];

    public function category()
    {
        return $this->belongsTo(Categories::class, 'product_category_id');
    }

    public function subCategory()
    {
        return $this->belongsTo(ProductSubCategory::class, 'sub_category_id');
    }

    public function productDetails()
    {
        return $this->hasMany(ProductsDetails::class, 'product_id');
    }

}
