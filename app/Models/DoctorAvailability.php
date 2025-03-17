<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DoctorAvailability extends Model
{
     use HasFactory;
     protected $fillable = ['doctor_id','date','time_slot'];

     /**
      * Get the doctor that owns the DoctorAvailability
      *
      * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
      */
     public function doctor()
     {
         return $this->belongsTo(User::class, 'doctor_id');
     }
     /***
      * Get the appointments for the user.
      */
     public function appointments()
     {
         return $this->hasMany(Appointment::class, 'doctor_availability_id','id');
     }
}
