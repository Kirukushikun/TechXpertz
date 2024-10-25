@include('components.header-footer')
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>TechXpertz</title>
        <!-- Crucial Part on every forms -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Crucial Part on every forms/ -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="{{ asset('css/Customer/header-footer.css') }}">
        <link rel="stylesheet" href="{{ asset('css/Customer/8 - Messages.css') }}">
        @livewireStyles
    </head>
    <body id="main-body">

        <div class="modal" id="modal">
        </div>

        @yield('header')    

        @livewire('Chat.CustomerChat')

        @yield('footer')

        @livewireScripts

        <script>
            function scrollToBottom() {
                var messageContainer = document.querySelector('.messages-container');
                if (messageContainer) {
                    messageContainer.scrollTo({
                        top: messageContainer.scrollHeight,
                        behavior: 'smooth'
                    });
                }
            }
        </script>

        <script>
            window.addEventListener('load', function(){
                var messageContainer = document.querySelector('.messages-container');

                // Create a new MutationObserver instance
                const observer = new MutationObserver((mutationsList, observer) => {
                    mutationsList.forEach((mutation) => {
                        console.log(mutation); // This will log the mutation object when something changes
                        // Scroll to bottom when a mutation occurs
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
                if (messageContainer) {
                    observer.observe(messageContainer, config);
                }

                // Ensure that it scrolls to the bottom on page load
                scrollToBottom();
            });
        </script>

    </body>

</html>