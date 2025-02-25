<?php

namespace App\Models\AllRegularEntry;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierInquiry extends Model
{
    use HasFactory;

    protected $table = 'supplier_inquiries';

    protected $primaryKey = 'id';

    public $timestamps = false; // Disable timestamps if `created_at` and `updated_at` are not used

    protected $fillable = [
        'submission_date',
        'system_generated_inquiry_number',
        'supplier_id',
        'customer_inquiry_number',
        'customer_id',
        'shipment_mode',
        'expected_arrival_date',
        'payment_term',
        'inquiry_validity',
        'authorization_status',
        'remarks',
        'sample_need',
        'status',
        'create_by',
        'create_date',
        'update_by',
        'update_date'
    ];
}
