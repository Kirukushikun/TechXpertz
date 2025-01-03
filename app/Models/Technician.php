<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Notifications\TechnicianResetPasswordNotification;

class Technician extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'technicians'; // Ensure this matches your table name

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'profile_status',

        'firstname',
        'middlename',
        'lastname',

        'email',

        'contact_no',
        'educational_background',
        
        'province',
        'city',
        'barangay',
        'zip_code',

        'date_of_birth',

        'username',
        'password',
        'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'date_of_birth' => 'date',
    ];

    // Relationship with Repairshop Credentials
    public function repairshopCredentials()
    {
        return $this->hasOne(RepairShop_Credentials::class);
    }

    // Relationship with Repairshop Services
    public function repairshopServices()
    {
        return $this->hasMany(RepairShop_Services::class);
    }

    // Relationship with Repairshop Schedules
    public function repairshopSchedules()
    {
        return $this->hasMany(RepairShop_Schedules::class);
    }

    // Relationship with Repairshop Profile
    public function repairshopProfile()
    {
        return $this->hasOne(RepairShop_Profiles::class);
    }

    // Relationship with Repairshop Reviews
    public function repairshopReviews()
    {
        return $this->hasMany(RepairShop_Reviews::class);
    }

    // Relationship with Repairshop Socials
    public function repairshopSocials()
    {
        return $this->hasOne(RepairShop_Socials::class);
    }

    // Relationship with Repairshop Mastery
    public function repairshopMastery()
    {
        return $this->hasOne(RepairShop_Mastery::class);
    }

    // Relationship with Repairshop Badges
    public function repairshopBadges()
    {
        return $this->hasOne(RepairShop_Badges::class);
    }

    // Relationship with Technician Notifications
    public function technicianNotifications()
    {
        return $this->hasMany(Technician_Notifications::class);
    }

    // Relationship with Technician Appointments
    public function repairshopAppointments()
    {
        return $this->hasMany(RepairShop_Appointments::class);
    }

    // Relationship with Technician Appointments
    public function repairshopRepairStatus()
    {
        return $this->hasMany(RepairShop_RepairStatus::class);
    }

    // Relationship with Technician Images
    public function repairshopImages()
    {
        return $this->hasOne(RepairShop_Images::class);
    }

    public function conversation(){
        return $this->hasMany(Conversation::class);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new TechnicianResetPasswordNotification($token));
    }
}
