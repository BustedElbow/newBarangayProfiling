<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BloodRelation extends Model
{
    use HasFactory;
    protected $table = 'blood_relations';

    protected $primaryKey = 'blood_relation_id';

    protected $fillable = [
        'related_to_resident_id',
        'name',
        'relationship',
        'resident_id',
    ];
}
