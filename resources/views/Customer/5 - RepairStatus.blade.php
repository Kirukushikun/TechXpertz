@include('components.header-footer')
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>TechXpertz</title>
        <link rel="icon" href="{{ asset('images/TechXpertz-Icon.ico') }}">
        <!-- Crucial Part on every forms -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Crucial Part on every forms/ -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        
        <link rel="stylesheet" href="{{ asset('css/Customer/customer-headerfooter.css') }}">
        <link rel="stylesheet" href="{{ asset('css/Customer/customer-loadingscreen.css') }}">
        <link rel="stylesheet" href="{{ asset('css/Customer/customer-modal.css') }}">
        <link rel="stylesheet" href="{{ asset('css/Customer/customer-notification.css') }}">

        <link rel="stylesheet" href="{{ asset('css/Customer/5 - RepairStatus.css') }}">

    </head>
    <body>

        @if(session()->has('error'))
            <div class="push-notification danger active">
                <i class="fa-solid fa-bell danger"></i>
                <div class="notification-message">
                    <h4>{{session('error_message')}}</h4>
                    <p>{{session('error')}}</p>
                </div>
                <i class="fa-solid fa-xmark" id="close-notification"></i>
            </div>
        @elseif(session()->has('success'))
            <div class="push-notification success active">
                <i class="fa-solid fa-bell success"></i>
                <div class="notification-message">
                    <h4>{{session('success')}}</h4>
                    <p>{{session('success_message')}}</p>
                </div>
                <i class="fa-solid fa-xmark" id="close-notification"></i>
            </div>
        @endif

    <div class="loading-screen">
        <div class="loader"></div>
    </div>

    <div class="modal" id="modal">
      
    </div>

        @yield('header')
        
        <div class="container-repair-status">

            <div class="upper">
                <div class="header">
                    <h1>Track Your Repair Status</h1>
                    <p>Stay updated with your device’s repair progress. Check real-time updates, including the current status, estimated completion time, and any changes in the repair process.</p>
                </div>
            </div>


            <div class="lower">
                <div class="repair-info">
                    <p>Repair ID:</p>
                    <span><b>#{{$repairstatusData->id}}</b></span>
                    <!-- <ul>
                        <li><strong>1x</strong> Original LED Replacement</li>
                        <li><strong>1x</strong> Original Battery Replacement</li>
                    </ul> -->
                </div>


                <div class="timeline">
                    @foreach($repairstatusDetails as $repairstatus)
                        @if($repairstatus->repairstatus == "Device Collected")
                            <div class="timeline-item">
                                <div class="timeline-indicator {{$loop->last ? 'first' : '' }}">
                                    <i class="fa-solid fa-circle" style="color:#FFD700;"></i>
                                </div>
                                <div class="timeline-status">
                                    <h3>Write a Review</h3>
                                </div>
                                
                                <div class="timeline-description">
                                    <p>We’d love to hear your feedback! Please take a moment to rate your experience with our repair service. Your input helps us improve and provide the best possible service to our customers.</p>
                                    @if($loop->first)
                                        <button id="rate-repair" data-technician-id="{{$repairstatusData->technician_id}}" data-repair-id="{{$repairstatus->repair_id}}">
                                            Rate <i class="fa-solid fa-star"></i>
                                        </button>
                                    @endif
                                </div>
                            </div>

                            <div class="timeline-item">
                                <div class="timeline-indicator {{$loop->last ? 'first' : '' }}">
                                    <i class="fa-solid fa-circle"></i>
                                    <span></span>
                                </div>
                                <div class="timeline-status">
                                    <h3>{{$repairstatus->repairstatus}}</h3>
                                    <p>{{$repairstatus->formatted_date}}, {{$repairstatus->formatted_time}}</p>
                                </div>
                                
                                <div class="timeline-description">
                                    <p>{{$repairstatus->repairstatus_message}}</p>
                                </div>
                            </div>
                        @elseif($repairstatus->repairstatus == "Review Submitted")
                            <div class="timeline-item">
                                <div class="timeline-indicator {{$loop->last ? 'first' : '' }}">
                                    <i class="fa-solid fa-circle" style="color:#FFD700;"></i>
                                    <span style="background-color:#FFD700;"></span>
                                </div>
                                <div class="timeline-status">
                                    <h3>Review Submitted</h3>
                                </div>
                                <div class="timeline-description">
                                    <p>Thank you for taking the time to rate and review the repair shop! Your feedback helps both the shop and future customers. We truly appreciate your input and support!</p>
                                </div>
                            </div>
                        @else
                            <div class="timeline-item">
                                <div class="timeline-indicator {{$loop->last ? 'first' : '' }}">
                                    <i class="fa-solid fa-circle"></i>
                                    @if(!$loop->last)
                                    <span></span>
                                    @endif
                                </div>

                                <div class="timeline-status">
                                    <h3>{{$repairstatus->repairstatus}}</h3>
                                    <p>{{$repairstatus->formatted_date}}, {{$repairstatus->formatted_time}}</p>
                                </div>

                                <div class="timeline-description">
                                    <p>{{$repairstatus->repairstatus_message}}</p>

                                    @if($repairstatus->repairstatus == "Appointment Requested" || $repairstatus->repairstatus == "Appointment Confirmed")
                                        <!-- Display the cancel button only for the last status -->
                                        @if($loop->first)
                                            @php
                                                $status = App\Models\RepairShop_RepairStatus::find($repairstatusData->id);
                                            @endphp
                                            @if($status->repairstatus != "Appointment Cancelled")
                                                <button id="cancel-appointment" data-repair-id="{{$repairstatusData->id}}">
                                                    Cancel {{$repairstatus->repairstatus == "Appointment Requested" ? 'Request' : 'Appointment'}}
                                                </button>
                                            @endif
                                        @endif
                                    @endif
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>            
            </div>
            
        </div>

        @yield('footer')

        
    </body>
    <script src="{{asset('js/Customer/5 - RepairStatus.js')}}" defer></script>
    <script src="{{asset('js/Customer/customer-loadingscreen.js')}}" defer></script>
    <script src="{{asset('js/Customer/customer-notification.js')}}" defer></script>
    <script src="{{asset('js/Customer/header-footer.js')}}" defer></script>
</html>
