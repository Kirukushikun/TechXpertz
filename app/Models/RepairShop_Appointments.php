<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class RepairShop_Appointments extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'repairshop_appointments'; // Ensure this matches your table name

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'technician_id',
        'customer_id',
        'status',

        'fullname',
        'email',
        'contact_no',

        'device_type',
        'device_brand',
        'device_model',
        'device_serial',

        'issue_descriptions',
        'error_messages',
        'repair_attempts',
        'recent_events',
        'prepared_parts',
        
        'appointment_date',
        'appointment_time',
        'appointment_urgency',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'appointment_date' => 'datetime:H:i:s',
        'appointment_time' => 'datetime:H:i:s',
    ];

    public function technician()
    {
        return $this->belongsTo(Technician::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

}
