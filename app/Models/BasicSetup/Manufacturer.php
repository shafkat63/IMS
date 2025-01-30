<?php

namespace App\Models\BasicSetup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    use HasFactory;
    protected $table = 'manufacturer';
    protected $fillable = [
        'name',
        'country_id',
        'status',
        'create_by',
        'create_date',
        'update_by',
        'update_date'
    ];
    public $timestamps = false;
}
