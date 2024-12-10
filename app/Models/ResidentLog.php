<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResidentLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'resident_id',
        'official_id',
        'field_changed',
        'old_value',
        'new_value',
        'action',
        'timestamp',
    ];
}
