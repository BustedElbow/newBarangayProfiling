<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Household extends Model
{
    use HasFactory;

    protected $primaryKey = 'household_id';

    protected $fillable = [
        'household_name',
    ];

    public function members() {
        return $this->hasMany(HouseholdMember::class, 'household_id', 'household_id');
    }
    
}
