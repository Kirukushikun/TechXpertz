<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer_RepairStatus extends Model
{
    use HasFactory;

        /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'customer_repairstatus'; // Ensure this matches your table name

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'technician_id',
        'repair_id',
        'customer_id',
        
        'repairstatus',
        'repairstatus_message',

        'repairstatus_conditional',
        'conditional_message',
        
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
