<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseholdMember extends Model
{
    use HasFactory;

    protected $primaryKey = 'household_mem_id';
    protected $fillable = [
        'household_id',
        'resident_id',
        'is_head',
    ];

    public function resident() {
        return $this->belongsTo(Resident::class, 'resident_id', 'resident_id');
    }

    public function household() {
        return $this->belongsTo(Household::class, 'household_id', 'household_id');
    }
}
