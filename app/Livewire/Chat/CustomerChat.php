<?php

namespace App\Livewire\Chat;

use Livewire\Component;

use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CustomerChat extends Component
{   
    public function render()
    {
        return view('livewire.chat.customer-chat');
    }
}
