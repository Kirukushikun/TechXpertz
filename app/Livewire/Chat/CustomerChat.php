<?php

namespace App\Livewire\Chat;

use Livewire\Component;
use App\Models\Customer;
use App\Models\Technician;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class CustomerChat extends Component
{   
    public $messageText;

    public $messages;
    public $conversations = [];

    public $activeConversationID;
    public $activeConversation;

    public function mount(){
        $this->loadChatList();
        $this->setActiveConversation($this->activeConversationID);
    }

    public function setActiveConversation($conversationID){
        $this->activeConversationID = $conversationID;
        $this->activeConversation = Conversation::find($conversationID);
        $this->loadMessages();
    }

    public function loadMessages(){
        if($this->activeConversationID){
            $this->messages = Message::where('conversation_id', $this->activeConversationID)
                ->orderBy('created_at', 'asc')
                ->get();
        }
    }

    public function loadChatList(){
        if(Auth::check()){
            $customerID = Auth::user()->id;
            $this->conversations = Conversation::where('sender_id', $customerID)
                ->orderByDesc('updated_at')
                ->get();

            if(!$this->activeConversationID && $this->conversations->isNotEmpty()){
                $this->activeConversationID = $this->conversations->first()->id;
                $this->activeConversation = $this->conversations->first();
            }
        }
    }

    public function sendMessage(){

        Message::create([
            'body' => $this->messageText,
            'sender_id' => Auth::user()->id,
            'sender_type' => 'customer',
            'receiver_id' => $this->getReceiverID(),
            'receiver_type' => 'technician',
            'conversation_id' => $this->activeConversationID,
        ]);

        //It updates the last updated
        $conversation = Conversation::find($this->activeConversationID);
        $conversation->touch();

        // Clear the input after sending the message
        $this->messageText = '';

        // Reload messages to include the new message
        $this->loadMessages();
        // Reload Chat list with the latest conversation
        $this->loadChatList();
    }

    public function getReceiverID(){
        $conversation = $this->activeConversation;
        if($conversation->receiver_type === 'technician'){
            return $conversation->receiver_id;
        }elseif($conversation->sender_type === 'technician'){
            return $conversation->sender_id;
        }
        return null;
    }

    public function render()
    {
        $this->loadMessages();
        $this->loadChatList();
        return view('livewire.customer-chat', [
            'conversations' => $this->conversations,
            'activeConversation' => $this->activeConversation,
        ]);
    }
}
