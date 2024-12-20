<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Official extends Model
{
    use HasFactory;

    protected $primaryKey = 'official_id';
    
    protected $fillable= [
        'resident_id',
        'position',
        'term_start',
        'term_end',
        'is_active',
    ];

    public function resident() {
        return $this->belongsTo(Resident::class, 'resident_id', 'resident_id');
    }

    public function isTermEnded(): bool
    {
        return Carbon::parse($this->term_end)->isPast();
    }
}
