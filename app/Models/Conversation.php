<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

        /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'conversations'; // Ensure this matches your table name

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        
        'sender_id',
        'sender_type',

        'receiver_id',
        'receiver_type',
    ];

    public function messages(){
        return $this->hasMany(Message::class);
    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function technician(){
        return $this->belongsTo(Technician::class);
    }

}
