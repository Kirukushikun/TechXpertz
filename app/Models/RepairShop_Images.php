<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepairShop_Images extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'repairshop_images'; // Ensure this matches your table name

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'technician_id',
        'gallery_status',
        'image_profile',
        'image_2',
        'image_3',
        'image_4',
        'image_5',
    ];

    public function technician()
    {
        return $this->belongsTo(Technician::class);
    }
}
