<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class locations extends Model
{
    use HasFactory;
    protected $table="locations";
    protected $fillable=['name'];



    public function sensors()
    {
        return $this->hasMany(sensors::class);
    }
    public function visitors()
    {
        return $this->hasMany(visitors::class);
    }
}
