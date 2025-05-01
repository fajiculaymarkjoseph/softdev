<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    // ✅ Specify the custom primary key
    protected $table = 'admins';   
    protected $primaryKey = 'AdminID';

    protected $fillable = ['name', 'email', 'password'];

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'AdminID');
    }
}
