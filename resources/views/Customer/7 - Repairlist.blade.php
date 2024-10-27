@include('components.header-footer')
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>TechXpertz</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        
        <link rel="stylesheet" href="{{ asset('css/Customer/customer-headerfooter.css') }}">
        <link rel="stylesheet" href="{{ asset('css/Customer/customer-loadingscreen.css') }}">
        <link rel="stylesheet" href="{{ asset('css/Customer/customer-modal.css') }}">
        <link rel="stylesheet" href="{{ asset('css/Customer/customer-notification.css') }}">
        
        <link rel="stylesheet" href="{{ asset('css/Customer/7 - Repairlist.css') }}">
    </head>

    <div class="loading-screen">
        <div class="loader"></div>
    </div>

    <body>

        @yield('header')
        
        <div class="upper">
            <div class="header">
                <h1>Track Your Repair Status</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
            </div>
            <form class="search-box">
                <input type="number" id="repairId" name="repairId" placeholder="Please enter your repair ID here" required>
                <button type="submit" id="repairBtn">Track Repair Status</button>
            </form>
        </div>

        <div class="repair-list-container">
            @foreach($repairDetails as $repair)

                <div class="repair-card">
                    <div class="img">
                        
                    </div>
                    
                    @php
                        $deviceInfo = App\Models\RepairShop_Appointments::find($repair->appointment_id);
                    @endphp

                    <div class="repair-info">
                        <div class="left-details">
                            <div class="device-details">
                                <p class="repair-id">#{{$repair->id}}</p>
                                <h2 class="repair-name">{{$deviceInfo->device_model}}</h2>
                                <p class="repair-status">{{$repair->repairstatus}}</p>                        
                            </div>

                            <div class="repairshop-details">
                                <p>Repair Shop:</p>
                                <h3>{{$repair->technician->repairshopCredentials->shop_name}}</h3> <!-- Access repair shop name -->
                                <ul class="repair-features" style="list-style-type: none;">
                                    <li><i class="fa-solid fa-check"></i>{{$repair->technician->repairshopBadges->badge_1}}</li>
                                    <li><i class="fa-solid fa-check"></i>{{$repair->technician->repairshopBadges->badge_2}}</li>
                                    <li><i class="fa-solid fa-check"></i>{{$repair->technician->repairshopBadges->badge_3}}</li>
                                    <li><i class="fa-solid fa-check"></i>{{$repair->technician->repairshopBadges->badge_4}}</li>
                                </ul>                        
                            </div>
                        </div>

                        <div class="right-details">
                            <div class="repair-payment-status">
                                <p>Paid Status:</p>
                                <h4>{{$repair->paid_status}}</h4>
                            </div>

                            <div class="repair-payment-cost">
                                <p>Repair Cost:</p>
                                <h1 class="repair-cost">P {{$repair->revenue}}</h1>
                            </div>
                            
                            <div class="repair-buttons">
                                <button class="repair-view-details load" onclick="window.location.href='{{ route('viewrepairstatus', ['id' => $repair->id]) }}'">View Details</button>
                                <button class="repair-chat load">
                                    <i class="fa-solid fa-message"></i>
                                </button>
                            </div>                    
                        </div>
                    </div>
                    
                </div>
            @endforeach
        </div>

        @yield('footer')
        
        <script src="{{asset('js/Customer/customer-loadingscreen.js')}}" defer></script>
    </body>
    
</html>
