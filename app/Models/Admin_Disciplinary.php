<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin_Disciplinary extends Model
{
    use HasFactory;
/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'admin_disciplinary'; // Ensure this matches your table name

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'technician_id',
        'violation_level',
        'violation_header',
        'violation_offense',
        'violation_description',

        'date_of_incident',
        'resolution_date',
        'status',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'date_of_incident' => 'datetime:H:i:s',
        'resolution_date' => 'datetime:H:i:s',
    ];
}
