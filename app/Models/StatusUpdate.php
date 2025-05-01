<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusUpdate extends Model
{
    use HasFactory;

    protected $fillable = ['status'];

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'StatusID');
    }
}
