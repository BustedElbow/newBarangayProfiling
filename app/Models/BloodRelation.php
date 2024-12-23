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
        'related_to_resident_id', //Resident ID that the person is related to
        'name',
        'relationship',
        'resident_id', //Resident ID of the person
    ];

    public function resident() {
        return $this->belongsTo(Resident::class, 'resident_id');
    }

    public function relatedResident() {
        return $this->belongsTo(Resident::class, 'related_to_resident_id');
    }

}
