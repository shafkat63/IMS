<?php

namespace App\Models\BasicSetup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $table = 'countries';


    public $timestamps = false; 

    protected $fillable = [
        'name',
        'status',
        'create_by',
        'create_at',
        'update_by',
        'update_at'
    ];

}
