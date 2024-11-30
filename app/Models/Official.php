<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Official extends Model
{
    use HasFactory;

    protected $fillable= [
        'resident_id',
        'position',
        'term_start',
        'term_end',
    ];

    public function resident() {
        return $this->belongsTo(Resident::class, 'resident_id', 'resident_id');
    }
}
