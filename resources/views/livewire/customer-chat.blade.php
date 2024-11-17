<div class="chat-container">
    
    <aside class="sidebar">
        <div class="search-bar">
            <h2>Messages</h2>
        </div>
        
        <div class="messages" wire::poll.1s>  
            @if($conversations)
                @foreach($conversations as $conversation)
                    @php
                        $technician = App\Models\RepairShop_Credentials::where('technician_id', $conversation->receiver_id)
                            ->first();

                        $recentMessage = App\Models\Message::where('conversation_id', $conversation->id)
                            ->orderBy('created_at', 'desc')
                            ->first();

                        $technicianData = App\Models\RepairShop_Credentials::where('technician_id', $conversation->receiver_id)
                            ->first();
                        
                        $technicianProfile = App\Models\RepairShop_Images::where('technician_id', $conversation->receiver_id)
                            ->first();
                    @endphp

                    <div class="contact {{ $conversation->id == $activeConversation->id ? 'active' : '' }}" 
                        wire:click="setActiveConversation({{ $conversation->id }})">
                        @if($technician && $technicianProfile->image_profile)
                            <span id="image" style="background-image: url('{{ asset($technicianProfile->image_profile) }}');"></span>
                        @else
                            <span id="image"><i class="fa-solid fa-user"></i></span>
                        @endif
                        <div class="contact-info">
                            <div class="name">
                                <h4>{{$technician->shop_name}}</h4>
                                @if($recentMessage)
                                    <span class="time">{{$recentMessage->created_at->format('H:i')}}</span>
                                @endif
                            </div>
                            <div class="recent-chat">
                                @if($recentMessage)
                                    @if($recentMessage->sender_type == 'customer')
                                        You: {{ Str::limit($recentMessage->body, 15, '...') }}
                                    @else
                                        {{ Str::limit($recentMessage->body, 15, '...') }}
                                    @endif                                
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach  
            @endif
            
            <!-- isEmpty works and shows the message, else from the if statement above doesnt work so we just used forbidden jutsu bellow just for the sake of showing a message if chat list is empty -->
            @if($conversations->isEmpty())
                <div class="empty-messages">
                    <p>No available contacts</p>
                </div>
            @endif
        </div>
    </aside>

    <main class="chat-area">
        @if($conversations->isNotEmpty())
            <header class="chat-header">
                @php 
                    $activeTechnicianProfile = App\Models\RepairShop_Images::where('technician_id', $activeConversation->receiver_id)
                                ->first();
                    $activeTechnicianData = App\Models\RepairShop_Credentials::where('technician_id', $activeConversation->receiver_id)
                            ->first();
                @endphp
                <!-- <i class="fa-solid fa-arrow-left back-btn"></i> -->
                @if($activeTechnicianProfile->image_profile)
                    <span id="image" style="background-image: url('{{ asset($activeTechnicianProfile->image_profile) }}');"></span>
                @else
                    <span id="image"><i class="fa-solid fa-user"></i></span>
                @endif

                <h2 onclick="window.location.href='{{ route('viewshop', ['id'=> $activeTechnicianData->technician_id]) }}'">{{$activeTechnicianData->shop_name}}</h2>
            </header>

            @if($messages->isEmpty())
                <div class="empty-messages">
                    <img src="{{asset('images/message-x.png')}}" alt="">
                    <p>
                        You haven't started any conversations yet.
                    </p>
                </div>
            @endif
            <div class="messages-container" wire:poll.1s>
                @foreach($messages as $message)
                    <div class="message {{$message->sender_id == Auth::user()->id && $message->sender_type == 'customer' ? 'sent' : 'received'}}">
                        <p>{{$message->body}}</p>
                        <span class="time">
                        {{ $message->created_at->format('H:i') }}
                        </span>
                    </div>
                @endforeach
                <div id="scrollToBottom"></div>
            </div>
            <form wire:submit.prevent="sendMessage" class="message-input">
                <i class="fa-regular fa-face-smile emoji"></i>
                <input type="text" wire:model="messageText" autocomplete="off" maxlength="1700" placeholder="Write a message" required>
                <button type="submit"><i class="fa-solid fa-paper-plane"></i></button>
            </form>
        @else
            <div class="empty-messages" style="box-shadow: rgba(190, 197, 204, 0.2) 0px 8px 24px; border-radius:7px; background-color:white;">
                <img src="{{asset('images/message-x.png')}}" alt="">
                <p>
                    You haven't started any conversations yet.
                </p>
            </div>
        @endif

    </main>
</div>   




