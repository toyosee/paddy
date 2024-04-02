<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RideUser extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'ride_id'];

    public function rides()
    {
        return $this->belongsToMany(Ride::class)->withTimestamps();
    }
}
