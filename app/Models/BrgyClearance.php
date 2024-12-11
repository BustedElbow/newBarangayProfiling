<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrgyClearance extends Model
{
    use HasFactory;

    protected $primaryKey = 'clearance_id';

    protected $fillable = [
        'resident_id',
        'request_date',
        'purpose',
        'status',
        'processed_by',
        'processed_date'
    ];

    protected $casts = [
        'request_date' => 'datetime',
        'processed_date' => 'datetime'
    ];

    public function resident()
    {
        return $this->belongsTo(Resident::class, 'resident_id', 'resident_id');
    }

    public function processor()
    {
        return $this->belongsTo(User::class, 'processed_by', 'id');
    }
}
