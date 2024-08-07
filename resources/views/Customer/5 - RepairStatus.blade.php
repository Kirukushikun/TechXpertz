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
                <div class="search-box">
                    <input type="text" placeholder="Please enter your repair ID here">
                    <button>Track Repair Status</button>
                </div>
            </div>


            <div class="lower">
                <div class="repair-info">
                    <p>Repair ID:</p>
                    <span><b>#4241415145425325323</b></span>
                    <ul>
                        <li><strong>1x</strong> Original LED Replacement</li>
                        <li><strong>1x</strong> Original Battery Replacement</li>
                    </ul>
                </div>


                <div class="timeline">

                    <div class="timeline-item">
                        <div class="timeline-indicator last">
                            <i class="fa-solid fa-circle"></i>
                            <span> </span>
                        </div>
                        <div class="timeline-status">
                            <h3>Device Collected</h3>
                            <p>Sat, 23 Jul 2024, 02:49 PM</p>
                        </div>
                        <div class="timeline-description">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
                        </div>
                    </div>
                    

                    <div class="timeline-item">
                        <div class="timeline-indicator">
                            <i class="fa-solid fa-circle"></i>
                            <span></span>
                        </div>
                        <div class="timeline-status">
                            <h3>Ready for Pickup</h3>
                            <p>Sat, 23 Jul 2024, 01:00 PM</p>
                        </div>
                        <div class="timeline-description">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-indicator">
                            <i class="fa-solid fa-circle"></i>
                            <span></span>
                        </div>
                        <div class="timeline-status">
                            <h3>Repair Completed</h3>
                            <p>Sat, 23 Jul 2024, 12:00 NN</p>
                        </div>
                        <div class="timeline-description">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-indicator">
                            <i class="fa-solid fa-circle"></i>
                            <span></span>
                        </div>
                        <div class="timeline-status">
                            <h3>Waiting for Parts</h3>
                            <p>Sat, 23 Jul 2024, 10:00 AM</p>
                        </div>
                        <div class="timeline-description">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-indicator">
                            <i class="fa-solid fa-circle"></i>
                            <span></span>
                        </div>
                        <div class="timeline-status">
                            <h3>Repair in Progress</h3>
                            <p>Fri, 22 Jul 2024, 03:49 PM</p>
                        </div>
                        <div class="timeline-description">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-indicator">
                            <i class="fa-solid fa-circle"></i>
                            <span></span>
                        </div>
                        <div class="timeline-status">
                            <h3>Diagnosis in Progress</h3>
                            <p>Fri, 22 Jul 2024, 01:49 PM</p>
                        </div>
                        <div class="timeline-description">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-indicator">
                            <i class="fa-solid fa-circle"></i>
                            <span></span>
                        </div>
                        <div class="timeline-status">
                            <h3>Device Dropped Off</h3>
                            <p>Fri, 22 Jul 2024, 11:49 AM</p>
                        </div>
                        <div class="timeline-description">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-indicator">
                            <i class="fa-solid fa-circle"></i>
                            <span></span>
                        </div>
                        <div class="timeline-status">
                            <h3>Appointment Confirmed</h3>
                            <p>Thu, 21 Jul 2024, 12:49 PM</p>
                        </div>
                        <div class="timeline-description">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
                        </div>
                    </div>
                    
                    <div class="timeline-item">
                        <div class="timeline-indicator first">
                            <i class="fa-solid fa-circle"></i>
                        </div>
                        <div class="timeline-status">
                            <h3>Appointment Requested</h3>
                            <p>Thu, 21 Jul 2024, 11:49 AM</p>
                        </div>
                        <div class="timeline-description">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
                        </div>
                    </div>                
                </div>            
            </div>

        </div>

        @yield('footer')

        <script>

        </script>
    </body>
</html>
