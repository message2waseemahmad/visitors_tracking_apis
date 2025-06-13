<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class visitors extends Model
{
    use HasFactory;

     protected $table = "visitors";
    protected $fillable = ['location_id','sensor_id', 'date','total_visitors'];


    public function location()
    {
        return $this->belongsTo(locations::class);
    }
    public function sensor()
    {
        return $this->belongsTo(sensors::class);
    }
}
