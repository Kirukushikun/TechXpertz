@include('components.header-footer')
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>TechXpertz</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="{{ asset('css/Customer/header-footer.css') }}">
        <link rel="stylesheet" href="{{ asset('css/Customer/7 - RepairStatus-Collection.css') }}">
    </head>
    <body>

        @yield('header')

        <div class="container">
            <div class="card">
                <div class="left">
                    <div class="card-image"></div>
                </div>

                <div class="right">
                    <div class="card-header">
                        TechXpertz
                    </div>
                    <div class="card-body">
                        <label for="device-type">Device Type:</label>
                        
                        <label for="brand">Brand:</label>
                        
                        <label for="device-model">Device Model:</label>
                        
                        <label for="serial-number">Serial Number:</label>
                        
                    </div>
                    <div class="card-footer">
                        <button>Device Collected</button>
                        <button>Chat</button>
                        <button>View</button>
                    </div>                
                </div>                
            </div>

            <div class="card">
                <div class="left">
                    <div class="card-image"></div>
                </div>

                <div class="right">
                    <div class="card-header">
                        TechXpertz
                    </div>
                    <div class="card-body">
                        <label for="device-type">Device Type:</label>
                        
                        <label for="brand">Brand:</label>
                        
                        <label for="device-model">Device Model:</label>
                        
                        <label for="serial-number">Serial Number:</label>
                        
                    </div>
                    <div class="card-footer">
                        <button>Device Collected</button>
                        <button>Chat</button>
                        <button>View</button>
                    </div>                
                </div>                
            </div>

        </div>

        @yield('footer')
    </body>
</html>