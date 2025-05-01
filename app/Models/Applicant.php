<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    use HasFactory;

    protected $fillable = ['last_name', 'first_name', 'middle_name', 'department', 'email'];

    public function interviewScheds()
    {
        return $this->hasMany(InterviewSched::class, 'ApplicantsID');
    }
}
