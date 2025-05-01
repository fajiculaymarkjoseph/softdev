<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable = ['score', 'status', 'InterviewID'];

    public function interviewSched()
    {
        return $this->belongsTo(InterviewSched::class, 'InterviewID');
    }
}
