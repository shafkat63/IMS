<?php

namespace App\Models\AllRegularEntry;

use App\Models\BasicSetup\Currency;
use App\Models\BasicSetup\ModeOfUnit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerInquiryDetails extends Model
{
    use HasFactory;
    protected $table = 'customer_inquiry_details'; 

    protected $primaryKey = 'id'; 

    public $timestamps = false;

    protected $fillable = [
        'inquiry_id',
        'product_name',
        'import_country_hs_code',
        'export_country_hs_code',
        'item_spec',
        'mode_of_unit_id',
        'manufacturer',
        'country_of_origin',
        'packing_size',
        'currency_id',
        'item_quantity',
        'status',
        'create_by',
        'create_date',
        'update_by',
        'update_date',
    ];

    public function inquiry()
    {
        return $this->belongsTo(CustomerInquiry::class, 'inquiry_id');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }

    public function modeOfUnit()
    {
        return $this->belongsTo(ModeOfUnit::class, 'mode_of_unit_id');
    }
}
