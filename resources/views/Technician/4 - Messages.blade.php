@include('components.technician-sidebar')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('css/Technician/technician-sidebar.css')}}">

    <link rel="stylesheet" href="{{asset('css/Technician/4 - Messages.css')}}">
</head>
<body>
    <div class="dashboard">

        @yield('sidebar')

        <main class="main-content">
            
            <div class="body">
                <div class="chat-container">
        
                    <main class="chat-area">
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
                        </div>
                        <footer class="message-input">
                            <i class="fa-regular fa-face-smile emoji"></i>
                            <input type="text" placeholder="Write a message">
                            <button><i class="fa-solid fa-paper-plane"></i></button>
                        </footer>
                    </main>

                    <aside class="sidebar">
                        <div class="search-bar">
                            <h2>Messages</h2>
                            <input type="text" placeholder="Search">
                        </div>
                        
                        <div class="messages">
                            <!-- Example Contact -->
                            <div class="contact active">
                                <img src="profile1.jpg" alt="">
                                <div class="contact-info">
                                    <div class="name">
                                        <h4>Lara Mueller</h4>
                                        <span class="time">17:33</span>
                                    </div>
                                    <p>Makes to a illustrated on all and...</p>
                                </div>
                            </div>
                            <div class="contact">
                                <img src="profile1.jpg" alt="">
                                <div class="contact-info">
                                    <div class="name">
                                        <h4>Gabrielle Josh</h4>
                                        <span class="time">17:33</span>
                                    </div>
                                    <p>Wapin Wapin...</p>
                                </div>
                            </div>
                            <div class="contact">
                                <img src="profile1.jpg" alt="">
                                <div class="contact-info">
                                    <div class="name">
                                        <h4>Jester Garcia</h4>
                                        <span class="time">17:33</span>
                                    </div>
                                    <p>Napakasakit kuya eddie...</p>
                                </div>
                            </div>
                            
                            
                            <!-- More contacts can be added here -->
                        </div>
                    </aside>                    
        
                </div>        
            </div>

        </main>
    </div>
    
    <script src="{{asset('js/Technician/4 - Messages.js')}}"></script>
    <script src="{{asset('js/Technician/technician-sidebar.js')}}"></script>
</body>
</html>
