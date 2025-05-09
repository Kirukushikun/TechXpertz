@include('components.technician-sidebar')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechXpertz</title>
    <link rel="icon" href="{{ asset('images/TechXpertz-Icon.ico') }}">
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
    <script src="{{asset('js/Technician/4 - Messages.js')}}" defer></script>
    <script src="{{asset('js/Technician/technician-sidebar.js')}}" defer></script>

</body>
</html>
