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
    @livewireStyles
</head>
<body>
    <div class="dashboard">

        @yield('sidebar')

        <main class="main-content">
            
            <div class="body">
                @livewire('Chat.TechnicianChat')
            </div>

        </main>
    </div>
    
    @livewireScripts
    <script src="{{asset('js/Technician/technician-sidebar.js')}}"></script>

    <script>
        window.addEventListener('load', function(){

            var messageContainer = document.querySelector('.messages-container');
            var scrollToBottomDiv = document.getElementById('scrollToBottom');

            // Create a new MutationObserver instance
            const observer = new MutationObserver((mutationsList, observer) => {
                mutationsList.forEach((mutation) => {
                    console.log(mutation); // This will log the mutation object when something changes
                    // You can also trigger a function or update UI here
                    scrollToBottom();
                });
            });

            // Configure the observer to look for changes to child elements, attributes, or text content
            const config = {
                childList: true, // Observe changes to the child elements (e.g., nodes added or removed)
                attributes: true, // Observe changes to attributes
                subtree: true, // Observe changes inside child elements of the div
                characterData: true // Observe changes to the text inside nodes
            };

            // Start observing the target div
            observer.observe(messageContainer, config);
        });

        scrollToBottom()
    </script>
</body>
</html>
