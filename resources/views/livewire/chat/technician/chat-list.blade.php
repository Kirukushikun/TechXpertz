<div class="messages">
    <!-- Example Contact -->
    @if($conversations->isNotEmpty())
        @foreach($conversations as $conversation)
            @php
                $receiverData = null;
                if($conversation->sender_type == "technician"){
                    $receiverData = \App\Models\Customer::find($conversation->receiver_id); // If the sender is technician get receivers data
                } elseif($conversation->receiver_type == "technician"){
                    $receiverData = \App\Models\Technician::find($conversation->sender_id); // if the receiver is technician get senders data
                }
            @endphp
            
            <div class="contact active" wire:click="loadConversation({{ $conversation->id }}, {{ $receiverData->id }})">
                <img src="profile1.jpg" alt="">
                <div class="contact-info">

                    <div class="name">
                        <h4>{{$receiverData->firstname}} {{$receiverData->middlename ?? ''}} {{$receiverData->lastname}}</h4>
                        <span class="time">{{ $conversation->updated_at->format('H:i') }}</span>
                    </div>
                    <p class="recent-chat">Wapin Wapin...</p>
                </div>
            </div>        
        @endforeach
    @else
        No contacts yet
    @endif

<!-- More contacts can be added here -->
</div>
