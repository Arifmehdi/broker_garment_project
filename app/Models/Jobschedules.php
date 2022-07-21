<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jobschedules extends Model
{
    use HasFactory;
    protected $table='jobschedules';
    protected $fillable = ['deal_id', 'title', 'description', 'start_date', 'end_date', 'feedback'];
}
