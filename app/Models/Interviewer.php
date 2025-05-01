<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interviewer extends Model
{
    use HasFactory;

    protected $fillable = ['DepartmentID', 'first_name', 'last_name', 'middle_name', 'email'];

    public function interviewScheds()
    {
        return $this->hasMany(InterviewSched::class, 'InterviewerID');
    }
}
