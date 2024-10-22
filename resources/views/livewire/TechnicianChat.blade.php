<div class="chat-container">
    <div class="chat-area">
        <header class="chat-header">
            @php 
                $customerData = null;
                if ($activeConversation) {
                    $customerData = $activeConversation->sender_type == 'customer' ? 
                        App\Models\Customer::find($activeConversation->sender_id) : 
                        App\Models\Customer::find($activeConversation->receiver_id);
                }
            @endphp

            @if($customerData)
                @if($customerData->image_profile)
                    <span id="image" style="background-image: url('{{ asset($customerData->image_profile) }}');"></span>
                @else
                    <span id="image"><i class="fa-solid fa-user"></i></span>
                @endif
                <h2>{{ $customerData->firstname }} {{ $customerData->middlename ?? '' }} {{ $customerData->lastname }}</h2>
            @endif
        </header>

        <!-- Messages Area -->
        <div class="messages-container" wire:poll.2s>
        @foreach($messages as $message)
            <div class="message {{ $message['sender_id'] == Auth::guard('technician')->id() && $message['sender_type'] == 'technician' ? 'sent' : 'received' }}">
                <p>{{ $message['body'] }}</p>
                <span class="time">
                    {{ \Carbon\Carbon::parse($message['created_at'])->timezone(config('app.timezone'))->format('H:i') }}
                </span>
            </div>
        @endforeach
            <div id="scrollToBottom"></div>
        </div>

        <!-- Message Input Form -->
        <form wire:submit.prevent="sendMessage" class="message-input">
            <i class="fa-regular fa-face-smile emoji"></i>
            <input type="text" wire:model="messageText" maxlength="1700" placeholder="Write a message">
            <button type="submit"><i class="fa-solid fa-paper-plane"></i></button>
        </form>
    </div>

    <!-- Contacts/Chat List -->
    <aside class="sidebar">
        <div class="search-bar">
            <h2>Messages</h2>
            <input type="text" placeholder="Search">
        </div>

        <div class="messages" wire:poll.2s>
            @foreach($conversations as $conversation)
                @php
                    $customer = $conversation->sender_type == 'customer' ? 
                        App\Models\Customer::find($conversation->sender_id) : 
                        App\Models\Customer::find($conversation->receiver_id);

                    $recentMessage = App\Models\Message::where('conversation_id', $conversation->id)
                        ->orderBy('created_at', 'desc')
                        ->first();
                @endphp
                <div class="contact {{ $conversation->id == $activeConversation->id ? 'active' : '' }}" 
                     wire:click="setActiveConversation({{ $conversation->id }})">
                    @if($customer && $customer->image_profile)
                        <span id="image" style="background-image: url('{{ asset($customer->image_profile) }}');"></span>
                    @else
                        <span id="image"><i class="fa-solid fa-user"></i></span>
                    @endif
                    <div class="contact-info">
                        <div class="name">
                            <h4>{{ $customer->firstname }} {{ $customer->middlename ?? '' }} {{ $customer->lastname }}</h4>
                            <span class="time">{{ $conversation->updated_at->format('H:i') }}</span>
                        </div>

                        <div class="recent-chat">
                        @if ($recentMessage->sender_type == 'technician')
                            You: {{ Str::limit($recentMessage->body, 15, '...') }}
                        @else
                            {{ Str::limit($recentMessage->body, 15, '...') }}
                        @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </aside>
</div>    



<script>
    function scrollToBottom() {
        var messageContainer = document.querySelector('.messages-container');
        var scrollToBottomDiv = document.getElementById('scrollToBottom');
        if (scrollToBottomDiv) {
            scrollToBottomDiv.scrollIntoView({ behavior: 'smooth' });
        }
    }
</script>

