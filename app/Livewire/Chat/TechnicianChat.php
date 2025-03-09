<?php

namespace App\Livewire\Chat;

use Livewire\Component;
use App\Models\Customer;
use App\Models\Technician;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class TechnicianChat extends Component
{
    public $messageText; // Holds the input message text
    public $activeConversationID; // Holds the currently active conversation ID
    public $messages; // Holds the messages of the active conversation
    public $conversations = []; // Holds the conversation list
    public $activeConversation; // Hold the active conversation model

    // On mount, we load the initial data
    public function mount()
    {
        $this->loadChatList(); // Load conversation list
        $this->setActiveConversation($this->activeConversationID); // Load the first active conversation
    }

    // Function to set the active conversation when a contact is clicked
    public function setActiveConversation($conversationID)
    {
        $this->activeConversationID = $conversationID;
        $this->activeConversation = Conversation::find($conversationID); // Set the active conversation model
        $this->loadMessages();
    }

    // Function to load the messages for the active conversation
    public function loadMessages()
    {
        if ($this->activeConversationID) {
            // Ensure the result is an array if it's being merged with an array later
            $this->messages = Message::where('conversation_id', $this->activeConversationID)
                ->orderBy('created_at', 'asc')
                ->get();
        }
    }

    // Function to load the conversation list for the technician
    public function loadChatList()
    {
        if (Auth::guard('technician')->check()) {
            $technicianID = Auth::guard('technician')->id();
            // Fetch conversations where the technician is either the sender or receiver
            $this->conversations = Conversation::where('sender_id', $technicianID)
                ->orWhere('receiver_id', $technicianID)
                ->orderByDesc('updated_at')
                ->get();

            // Set the first conversation as active if none is set
            if (!$this->activeConversationID && $this->conversations->isNotEmpty()) {
                $this->activeConversationID = $this->conversations->first()->id;
                $this->activeConversation = $this->conversations->first(); // Set the first conversation as active
            }
        }
    }

    // Function to send a message to the active conversation
    public function sendMessage(){

        Message::create([
            'body' => $this->messageText,
            'sender_id' => Auth::guard('technician')->id(),
            'sender_type' => 'technician',
            'receiver_id' => $this->getReceiverID(), // Get the customer ID for the conversation
            'receiver_type' => 'customer',
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

    // Helper function to get the receiver (customer) ID for the current conversation
    private function getReceiverID()
    {
        $conversation = $this->activeConversation;
        if ($conversation->sender_type === 'customer') {
            return $conversation->sender_id;
        } elseif ($conversation->receiver_type === 'customer') {
            return $conversation->receiver_id;
        }
        return null;
    }

    public function render()
    {   
        $this->loadMessages();
        $this->loadChatList();
        return view('livewire.technician-chat', [
            'conversations' => $this->conversations,
            'activeConversation' => $this->activeConversation, // Pass the active conversation to the view
        ]);
    }
}
