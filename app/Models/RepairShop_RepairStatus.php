<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class RepairShop_RepairStatus extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'repairshop_repairstatus'; // Ensure this matches your table name

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'technician_id',
        'customer_id',
        'appointment_id',

        'customer_fullname',
        
        'status',
        'paid_status',
        'revenue',
        'expenses',

        'repairstatus',
        'repairstatus_conditional',
        'repairstatus_message',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'revenue' => 'integer',
        'expenses' => 'integer',
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
