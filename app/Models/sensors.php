<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sensors extends Model
{
    use HasFactory;
    protected $table = "sensors";
    protected $fillable = ['name', 'location_id', 'status'];


    public function location()
    {
        return $this->belongsTo(locations::class);
    }
    public function visitors()
    {
        return $this->hasMany(visitors::class);
    }
}
