<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class RepairShop_Mastery extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'repairshop_mastery'; // Ensure this matches your table name

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'technician_id',
        
        'main_mastery',

        'smartphones',
        'tablets',
        'desktops',
        'laptops',
        'smartwatches',
        'cameras',
        'printers',
        'speakers',
        'drones',
        'all-in-one',
        
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'smartphones' => 'boolean',
        'tablets' => 'boolean',
        'desktops' => 'boolean',
        'laptops' => 'boolean',
        'smartwatches' => 'boolean',
        'cameras' => 'boolean',
        'printers' => 'boolean',
        'speakers' => 'boolean',
        'drones' => 'boolean',
        'all-in-one' => 'boolean',
    ];

    public function technician()
    {
        return $this->belongsTo(Technician::class);
    }
}
