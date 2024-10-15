@include('components.admin-sidebar')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <!-- Crucial Part on every forms -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Crucial Part on every forms/ -->
    <link rel="stylesheet" href="{{ asset('css/Admin/5 - ReviewsManagement.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Admin/admin-sidebar.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="dashboard">

        @yield('sidebar')

        <main class="main-content">
            <div class="head">
                <div class="logo">
                    <h2>Tech<span>X</span>pertz</h2>
                </div>

                @yield('navbar')

            </div>
            <div class="body">
                <div class="header">
                    <h1>Reviews Management</h1>
                    
                    <div class="tab-filters">
                        <li><button><i class="fa-solid fa-filter"></i>Filter</button></li>
                        <li><i class="fa-solid fa-magnifying-glass" id="search"></i> <input type="text" placeholder="search"></li>

                        <a class="add-repair"><i class="fa-solid fa-plus" id="add-appointment"></i></a>
                    </div>
                </div>

                <div class="content">
                    <ul class="tabs">
                        <div class="tab-navigation">
                            <li class="tab-link active" data-tab="pending-reviews">Pending</li>
                            <li class="tab-link" data-tab="approved-reviews">Approved</li>
                            <li class="tab-link" data-tab="rejected-reviews">Rejected</li>
                        </div>

                        <div class="tab-summary">
                            <p>Total Reviews: {{$reviewData->count()}}</p>
                            <p>Pending: {{$pendingReviews->count()}}</p>
                            <p>Approved: {{$approvedReviews->count()}}</p>
                            <p>Rejected: {{$rejectedReviews->count()}}</p>
                        </div>
                    </ul>

                    <div id="pending-reviews" class="tab-content-item active">
                        @foreach($pendingReviews as $pending)
                            <div class="review-item active" id="{{$pending->id}}">
                                <div class="left">
                                    <div class="review-header">
                                        <div class="title">
                                            Customer: <a href="">{{$pending->customer->firstname}} {{$pending->customer->lastname}}</a>
                                        </div>
                                        <div class="sub-title">
                                            Repairshop: 
                                            <span><a href="">{{$pending->technician->repairshopCredentials->shop_name}}</a></span> |
                                            Technician:
                                            <span><a href="">{{$pending->technician->firstname}} {{$pending->technician->middlename ?? ''}} {{$pending->technician->lastname}}</a></span> |
                                            {{$pending->created_at->format('M d, Y, h:i A')}}
                                        </div> 
                                    </div>
                                    <div class="review-content">
                                        <div class="header">
                                            <div class="ratings">Rating: 
                                                <span>
                                                    @for ($i = 1; $i <= $pending->rating; $i++ )
                                                    <span class="star"><i class="fa-solid fa-star"></i></span>
                                                    @endfor

                                                    <!-- Display empty stars for the remaining -->
                                                    @for ($i = $pending->rating + 1; $i <= 5; $i++)
                                                        <span class="star"><i class="fa-regular fa-star"></i></span>
                                                    @endfor
                                                </span>
                                            </div>
                                                                            
                                        </div>
                                        "{{$pending->review_comment}}"
                                    </div>                            
                                </div>

                                <div class="right">
                                    <button class="reviewbtn check" data-review-status="Approved" data-review-id="{{$pending->id}}"><i class="fa-solid fa-check"></i></button>
                                    <button class="reviewbtn exclamation" data-review-status="Rejected" data-review-id="{{$pending->id}}"><i class="fa-solid fa-xmark"></i></button>
                                </div>
                            </div>
                        @endforeach                        
                    </div>

                    <div id="approved-reviews" class="tab-content-item">
                        @foreach($approvedReviews as $approved)
                            <div class="review-item active" id="{{$approved->id}}">
                                <div class="left">
                                    <div class="review-header">
                                        <div class="title">
                                            Customer: <a href="">{{$approved->customer->firstname}} {{$approved->customer->lastname}}</a>
                                        </div>
                                        <div class="sub-title">
                                            Repairshop: 
                                            <span><a href="">{{$approved->technician->repairshopCredentials->shop_name}}</a></span> |
                                            Technician:
                                            <span><a href="">{{$approved->technician->firstname}} {{$approved->technician->middlename ?? ''}} {{$approved->technician->lastname}}</a></span> |
                                            {{$approved->created_at->format('M d, Y, h:i A')}}
                                        </div> 
                                    </div>
                                    <div class="review-content">
                                        <div class="header">
                                            <div class="ratings">Rating: 
                                                <span>
                                                    @for ($i = 1; $i <= $approved->rating; $i++ )
                                                    <span class="star"><i class="fa-solid fa-star"></i></span>
                                                    @endfor

                                                    <!-- Display empty stars for the remaining -->
                                                    @for ($i = $approved->rating + 1; $i <= 5; $i++)
                                                        <span class="star"><i class="fa-regular fa-star"></i></span>
                                                    @endfor
                                                </span>
                                            </div>
                                                                            
                                        </div>
                                        "{{$approved->review_comment}}"
                                    </div>                            
                                </div>

                                <div class="right">
                                    <button class="reviewbtn check" data-review-status="Approved" data-review-id="{{$approved->id}}"><i class="fa-solid fa-check"></i></button>
                                    <button class="reviewbtn exclamation" data-review-status="Rejected" data-review-id="{{$approved->id}}"><i class="fa-solid fa-xmark"></i></button>
                                </div>
                            </div>
                        @endforeach 
                    </div>

                    <div id="rejected-reviews" class="tab-content-item">
                        @foreach($rejectedReviews as $rejected)
                            <div class="review-item active" id="{{$rejected->id}}">
                                <div class="left">
                                    <div class="review-header">
                                        <div class="title">
                                            Customer: <a href="">{{$rejected->customer->firstname}} {{$rejected->customer->lastname}}</a>
                                        </div>
                                        <div class="sub-title">
                                            Repairshop: 
                                            <span><a href="">{{$rejected->technician->repairshopCredentials->shop_name}}</a></span> |
                                            Technician:
                                            <span><a href="">{{$rejected->technician->firstname}} {{$rejected->technician->middlename ?? ''}} {{$rejected->technician->lastname}}</a></span> |
                                            {{$rejected->created_at->format('M d, Y, h:i A')}}
                                        </div> 
                                    </div>
                                    <div class="review-content">
                                        <div class="header">
                                            <div class="ratings">Rating: 
                                                <span>
                                                    @for ($i = 1; $i <= $rejected->rating; $i++ )
                                                    <span class="star"><i class="fa-solid fa-star"></i></span>
                                                    @endfor

                                                    <!-- Display empty stars for the remaining -->
                                                    @for ($i = $rejected->rating + 1; $i <= 5; $i++)
                                                        <span class="star"><i class="fa-regular fa-star"></i></span>
                                                    @endfor
                                                </span>
                                            </div>
                                                                            
                                        </div>
                                        "{{$rejected->review_comment}}"
                                    </div>                            
                                </div>

                                <div class="right">
                                    <button class="reviewbtn check" data-review-status="Approved" data-review-id="{{$rejected->id}}"><i class="fa-solid fa-check"></i></button>
                                    <button class="reviewbtn exclamation" data-review-status="Rejected" data-review-id="{{$rejected->id}}"><i class="fa-solid fa-xmark"></i></button>
                                </div>
                            </div>
                        @endforeach 
                    </div>

                    <!-- <div class="review-item">
                        <div class="left">
                            <div class="review-header">
                                <div class="title">
                                    Customer: <a href="">Iverson Craig Guno</a>
                                </div>
                                <div class="sub-title">
                                    Repairshop: 
                                    <span><a href="">TechXpertz</a></span> |
                                    Technician:
                                    <span><a href="">Iverson Guno</a></span> |
                                    Wed, 04 Oct 2024, 09:30 AM
                                </div> 
                            </div>
                            <div class="review-content">
                                <div class="header">
                                    <div class="ratings">Rating: 
                                        <span>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </span>
                                    </div>
                                                                    
                                </div>
                                "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quisquam eaque non dicta fugiat sapiente perferendis aliquam expedita excepturi delectus unde. Quod tenetur sapiente recusandae nostrum non quibusdam provident rerum praesentium."
                            </div>                            
                        </div>

                        <div class="right">
                            <button class="check"><i class="fa-solid fa-check"></i></button>
                            <button class="exclamation"><i class="fa-solid fa-xmark"></i></button>
                        </div>
                    </div> -->
                </div>
            </div>
        </main>
    </div>

    <script src="{{ asset('js/Admin/admin-navbars.js') }}"></script>
    <script>
        let reviewButtons = document.querySelectorAll('button.reviewbtn');
        reviewButtons.forEach(button => {
            button.addEventListener('click', function(){
                let reviewID = button.getAttribute('data-review-id');
                let reviewStatus = button.getAttribute('data-review-status');
                updatereview(reviewID, reviewStatus);
            });
        });

        function updatereview(reviewID, reviewStatus){

            fetch(`/admin/reviewsmanagement/${reviewID}`, {
                method: 'PATCH', // You can use 'PUT' or 'PATCH' depending on your API design
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({ status: reviewStatus }) // Send necessary data in the body
            })
            .then(response => {
                if (response.ok) {
                    console.log('Review updated successfully');
                } else {
                    console.log('Review update failed');
                }
            })
            .catch(error => {
                console.log('There was an error with the request:', error);
            });

            let reviewItem = document.getElementById(reviewID);
            reviewItem.classList.remove('active');                
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('.tab-link');
            const contents = document.querySelectorAll('.tab-content-item');

            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    // Remove active class from all tabs and contents
                    tabs.forEach(t => t.classList.remove('active'));
                    contents.forEach(c => c.classList.remove('active'));
                    
                    // Add active class to the clicked tab and corresponding content
                    this.classList.add('active');
                    document.getElementById(this.dataset.tab).classList.add('active');
                });
            });
        });
    </script>
</body>
</html>
