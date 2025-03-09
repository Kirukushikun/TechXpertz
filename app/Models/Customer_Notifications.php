<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer_Notifications extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'customer_notifications'; // Ensure this matches your table name

    // The attributes that are mass assignable.
    protected $fillable = [
        'target_type',
        'target_id',
        'title',
        'message',
        'is_read',
    ];

    /**
     * Get the customer associated with the notification if target_type is 'customer'.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Mark the notification as read.
     */
    public function markAsRead()
    {
        $this->is_read = true;
        $this->save();
    }
}

