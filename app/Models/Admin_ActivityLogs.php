<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin_ActivityLogs extends Model
{
    use HasFactory;
        /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'admin_activitylogs'; // Ensure this matches your table name

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'technician_id',
        'customer_id',
        'action',
        'description',
        'status',
        'ip_address',
    ];

}
