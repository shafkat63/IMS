<?php

namespace App\Models\WebSetup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuAssign extends Model
{
    use HasFactory;
    protected $table = 'menu_assign';
    public $timestamps = false;

    protected $fillable = [
        'menu_id',
        'role',
        'status',
        'create_by',
        'create_date',
        'update_by',
        'update_date',
    ];
}
