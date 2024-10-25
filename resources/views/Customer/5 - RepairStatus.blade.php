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
        <link rel="stylesheet" href="{{ asset('css/Customer/5 - RepairStatus.css') }}">
        <link rel="stylesheet" href="{{ asset('css/Customer/customer-modal.css') }}">
    </head>
    <body>

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
                    <ul>
                        <li><strong>1x</strong> Original LED Replacement</li>
                        <li><strong>1x</strong> Original Battery Replacement</li>
                    </ul>
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

    <script>
        let modal = document.getElementById('modal');
        let cancelBtn = document.getElementById('cancel-appointment');
        let rateBtn = document.getElementById('rate-repair');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        cancelBtn.addEventListener('click', function(){
            let repairID = this.getAttribute('data-repair-id');
            modal.innerHTML = `
                <form action="/bookappointment/cancel/${repairID}" method="POST">
                    <input type="hidden" name="_token" value="${csrfToken}">
                    <input type="hidden" name="_method" value="PATCH">

                    <div class="modal-verification">
                        <i class="fa-solid fa-triangle-exclamation" id="repair"></i>
                        <div class="verification-message">
                            <h2>Cancel Request</h2>
                            <p>Are you sure you want to cancel your request?</p>                        
                        </div>
                        <div class="verification-action">
                            <button type="submit" class="submit">Cancel Appointment</button>
                            <button type="button" class="close normal"><b>Dismiss</b></button>
                        </div>
                    </div>                 
                </form>
            `;

            modal.classList.add('active');

            document.querySelector('.close').onclick = function () {
                modal.classList.remove('active');
            };
        });

    </script>

    <script>
        rateBtn.addEventListener('click', function(){
            let technicianID = this.getAttribute('data-technician-id');
            let repairID = this.getAttribute('data-repair-id');

            modal.innerHTML = `
                <form action="/review/${technicianID}" class="review-form" method="POST">
                    <input type="hidden" name="_token" value="${csrfToken}">

                    <input type="text" id="rating" name="rating" hidden>
                    <input type="text" id="repairID" name="repairID" value="${repairID}" hidden>

                    <div class="left">
                        <div class="review-header">
                            <h2>How would you rate our service?</h2>
                            <p>Please rate your experience with the repair service from the repair shop and provide a feedback.</p>
                        </div>
                        
                        <div class="review-rating">
                            <div class="star-container" id="starContainer">
                                <i class="fa-regular fa-star star" data-value="1"></i>
                                <i class="fa-regular fa-star star" data-value="2"></i>
                                <i class="fa-regular fa-star star" data-value="3"></i>
                                <i class="fa-regular fa-star star" data-value="4"></i>
                                <i class="fa-regular fa-star star" data-value="5"></i>
                            </div>                
                        </div>

                        <div class="review-comment">
                            <h4>Comment:</h4>
                            <textarea class="comment" name="comment" id="comment"></textarea>
                        </div>

                        <div class="review-action">
                            <button type="submit">Submit</button>
                            <a href="#" class="close">Maybe, later</a>
                        </div>
                        
                    </div>

                    <div class="right">
                        <!-- You can add more content here if needed -->
                    </div>
                </form> 
            `;

            rate();

            modal.classList.add('active');

            document.querySelector('.close').onclick = function (e) {
                e.preventDefault(); // Prevents anchor default action
                modal.classList.remove('active');
            };
        }); 

        function rate(){
            const stars = document.querySelectorAll('.star');
            let currentRating = 0;

            // Function to fill the stars up to the given rating
            const fillStars = (rating) => {
                stars.forEach(star => {
                    if (parseInt(star.getAttribute('data-value')) <= rating) {
                        star.classList.add('fa-solid');
                        star.classList.remove('fa-regular');
                    } else {
                        star.classList.remove('fa-solid');
                        star.classList.add('fa-regular');
                    }
                });
            };

            // Handle star hover
            stars.forEach(star => {
                star.addEventListener('mouseover', (e) => {
                    const hoverRating = parseInt(e.target.getAttribute('data-value'));
                    fillStars(hoverRating);
                });

                // Handle star click
                star.addEventListener('click', (e) => {
                    currentRating = parseInt(e.target.getAttribute('data-value'));
                    document.getElementById('rating').value = currentRating; // Set the hidden rating input value
                    fillStars(currentRating);
                });

                // Reset stars to current rating on mouseout
                star.addEventListener('mouseout', () => {
                    fillStars(currentRating);
                });
            });
        }
    </script>

    <script src="{{asset('js/Customer/customer-notification.js')}}"></script>
</html>
