<?php

namespace App\Models\AllRegularEntry;

use App\Models\BasicSetup\Customers;
use App\Models\BasicSetup\ShipmentMode;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerInquiry extends Model
{
    use HasFactory;
    protected $table = 'customer_inquiries'; 

    protected $primaryKey = 'id'; 

    public $timestamps = false;

    protected $fillable = [
        'inquiry_date',
        'system_generated_inquiry_number',
        'customer_id',
        'inquiry_account_manager',
        'shipment_mode_id',
        'expected_arrival_date',
        'payment_term',
        'inquiry_validity',
        'remarks',
        'authorization_status',
        'sample_needed',
        'status',
        'create_by',
        'create_date',
        'update_by',
        'update_date'
    ];

    
    public function customer()
    {
        return $this->belongsTo(Customers::class, 'customer_id');
    }

    public function shipmentMode()
    {
        return $this->belongsTo(ShipmentMode::class, 'shipment_mode_id');
    }
    public function details()
{
    return $this->hasMany(CustomerInquiryDetails::class, 'inquiry_id');
}

}
