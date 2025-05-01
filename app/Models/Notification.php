<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = ['DepartmentID', 'date_time', 'modality', 'StatusID'];

    public function admin()
    {
        // ✅ Use the correct foreign key reference
        return $this->belongsTo(Admin::class, 'AdminID');
    }

    public function statusUpdate()
    {
        return $this->belongsTo(StatusUpdate::class, 'StatusID');
    }
}
