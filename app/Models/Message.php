<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'messages'; // Ensure this matches your table name

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'body',
        'sender_id',
        'sender_type',

        'receiver_id',
        'receiver_type',

        'conversation_id',
        'read_at',
        
        'reciever_deleted_at',
        'sender_deleted_at',
    ];

    protected $dates=['read_at', 'reciever_deleted_at', 'sender_deleted_at',];

    public function conversation(){
        return $this->belongsTo(Conversation::class);
    }

    public function isRead():bool{
        return $this->read_at != null;
    }
}
