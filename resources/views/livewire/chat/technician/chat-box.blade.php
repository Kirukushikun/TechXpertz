<div class="chat-area">
    <header class="chat-header">
        <img src="profile1.jpg" alt="Lara Mueller">
        <h2>Lara Mueller</h2>
    </header>
    <div class="messages-container">
        <!-- Example Messages -->


        <div class="message received">
            <p>Both with sisters first very to remodelling logbook due and attempt...</p>
            <span class="time">17:57</span>
        </div>
        <div class="message sent">
            <p>Much to omens, accept would was basically.</p>
            <span class="time">18:49</span>
        </div>
        <!-- More messages can be added here -->
        <div id="scrollToBottom"></div>
    </div>
    <form wire:submit.prevent="sendMessage" class="message-input">
        @csrf
        <i class="fa-regular fa-face-smile emoji"></i>
        <input type="text" wire:model="messageText" name="messageText" autocomplete="off" maxlength="1700" placeholder="Write a message">
        <button type="submit"><i class="fa-solid fa-paper-plane"></i></button>
    </form>
</div>

<script>
    Livewire.on('messageSent', () => {
        var chatContainer = document.querySelector('.messages-container');
        chatContainer.scrollTop = chatContainer.scrollHeight;
    });
</script>