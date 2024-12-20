<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class purok extends Model
{
    use HasFactory;

    protected $primaryKey = 'purok_id';

    protected $fillable = [
        'purok_name',
        'purok_leader'
    ];

    public function leader() {
        return $this->belongsTo(Resident::class, 'purok_leader', 'resident_id');
    }
}
