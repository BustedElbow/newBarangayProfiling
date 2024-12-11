<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    use HasFactory;

    protected $table = 'residents';

    protected $primaryKey = 'resident_id';

    public $incrementing = true;

    protected $casts = [
        'birthdate' => 'date',
    ];

    protected $fillable = [
        'identification_number',
        'image',
        'first_name',
        'middle_name',
        'last_name',
        'sex',
        'birthdate',
        'age',
        'civil_status',
        'occupation',
        'educational_attainment',
        'contact_number',
        'address',
        'employer',
        'nationality',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'resident_id', 'resident_id');
    }

    public function bloodRelations()
    {
        return $this->hasMany(BloodRelation::class, 'resident_id');
    }

    public function relatedTo() {
        return $this->hasMany(BloodRelation::class, 'related_to_resident_id');
    }

    public function showResidents()
    {
        $residents = Resident::all();

        return view('admin.residents', compact('residents'));  // Pass residents to the view
    }

    public function householdMember() {
        return $this->hasOne(HouseholdMember::class, 'resident_id', 'resident_id');
    }

    public function official()
    {
        return $this->hasOne(Official::class, 'resident_id', 'resident_id');
    }
}
