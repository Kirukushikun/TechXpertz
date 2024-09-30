@include('components.header-footer')
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>TechXpertz</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="{{ asset('css/Customer/header-footer.css') }}">
        <link rel="stylesheet" href="{{ asset('css/Customer/5 - RepairStatus.css') }}">
    </head>
    <body>

        @yield('header')
        
        <div class="container-repair-status">

            <div class="upper">
                <div class="header">
                    <h1>Track Your Repair Status</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
                </div>
            </div>


            <div class="lower">
                <div class="repair-info">
                    <p>Repair ID:</p>
                    <span><b>#{{$repairstatusData->id}}</b></span>
                    <ul>
                        <li><strong>1x</strong> Original LED Replacement</li>
                        <li><strong>1x</strong> Original Battery Replacement</li>
                    </ul>
                </div>


                <div class="timeline">
                    @foreach($repairstatusDetails as $repairstatus)
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
                        </div>
                    </div>
                    @endforeach               
                </div>            
            </div>

        </div>

        @yield('footer')

    </body>
</html>
