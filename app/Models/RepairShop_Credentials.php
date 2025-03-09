<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class RepairShop_Credentials extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'repairshop_credentials'; // Ensure this matches your table name

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'technician_id',

        'shop_name',
        'shop_email',

        'shop_contact',
        'shop_address',

        'shop_province',
        'shop_city',
        'shop_barangay',
        'shop_zip_code',
        'shop_views',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'shop_email_verified_at' => 'datetime',
        'shop_views' => 'integer',
    ];

    public function technician()
    {
        return $this->belongsTo(Technician::class);
    }
}
