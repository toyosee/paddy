<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ride extends Model
{
    use HasFactory;

    protected $fillable = ['ride_type', 'ride_name', 'details', 'capacity'];


    // Relationship between ride and users
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
