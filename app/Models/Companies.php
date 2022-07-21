<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Companies extends Model
{
    use HasFactory;
    protected $casts = [
        'certificates' => 'array',
    ];
    protected $fillable = ['name', 'address', 'company_bio','company_profile_one','company_profile_two', 'trade_license', 'logo', 'certificates', 'phone','map', 'email', 'photo', 'machine_post_limits', 'work_post_limits','status'];
    
    function user(){
        return $this->hasMany(User::class,'id','company_id');
    }
    function Usermachines(){
        return $this->hasMany(Usermachines::class,'company_id','id');                                           
    }
    function Workorders(){
        return $this->hasMany(Workorders::class,'id','company_id');
    }
    function usermachine(){
        return $this->hasMany(Usermachines::class,'id','company_id');
    }

    function deal(){
        return $this->hasMany(Companies::class,'id','company_id');
    }

    function deals(){
        return $this->hasMany(Deals::class,'id','company_id');
    }

  
}
