<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterviewSched extends Model
{
    use HasFactory;

    protected $fillable = ['InterviewerID', 'ApplicantsID', 'modality', 'date_time', 'room_number', 'Applicant_status'];

    public function interviewer()
    {
        return $this->belongsTo(Interviewer::class, 'InterviewerID');
    }

    public function applicant()
    {
        return $this->belongsTo(Applicant::class, 'ApplicantsID');
    }

    public function result()
    {
        return $this->hasOne(Result::class, 'InterviewID');
    }
}
