@include('components.admin-sidebar')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
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
                    @foreach($reviewData as $review)
                    <div class="review-item active" id="{{$review->id}}">
                        <div class="left">
                            <div class="review-header">
                                <div class="title">
                                    Customer: <a href="">{{$review->customer->firstname}} {{$review->customer->lastname}}</a>
                                </div>
                                <div class="sub-title">
                                    Repairshop: 
                                    <span><a href="">{{$review->technician->repairshopCredentials->shop_name}}</a></span> |
                                    Technician:
                                    <span><a href="">{{$review->technician->firstname}} {{$review->technician->middlename ?? ''}} {{$review->technician->lastname}}</a></span> |
                                    {{$review->created_at->format('M d, Y, h:i A')}}
                                </div> 
                            </div>
                            <div class="review-content">
                                <div class="header">
                                    <div class="ratings">Rating: 
                                        <span>
                                            @for ($i = 1; $i <= $review->rating; $i++ )
                                            <span class="star"><i class="fa-solid fa-star"></i></span>
                                            @endfor

                                            <!-- Display empty stars for the remaining -->
                                            @for ($i = $review->rating + 1; $i <= 5; $i++)
                                                <span class="star"><i class="fa-regular fa-star"></i></span>
                                            @endfor
                                        </span>
                                    </div>
                                                                    
                                </div>
                                "{{$review->review_comment}}"
                            </div>                            
                        </div>

                        <div class="right">
                            <button class="reviewbtn check" data-review-status="approved" data-review-id="{{$review->id}}"><i class="fa-solid fa-check"></i></button>
                            <button class="reviewbtn exclamation" data-review-status="rejected" data-review-id="{{$review->id}}"><i class="fa-solid fa-xmark"></i></button>
                        </div>
                    </div>
                    @endforeach
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
                updatereview(reviewID);
            });
        });

        function updatereview(reviewID){

            let reviewItem = document.getElementById(reviewID);
            reviewItem.classList.remove('active');                
        }
    </script>
</body>
</html>
