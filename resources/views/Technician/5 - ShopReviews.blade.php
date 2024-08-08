@include('components.technician-sidebar')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Reviews</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('css/Technician/technician-sidebar.css')}}">

    <link rel="stylesheet" href="{{asset('css/Technician/5 - ShopReviews.css')}}">
</head>
<body>
    <div class="dashboard">

        @yield('sidebar')

        
        <main class="main-content">
            <header>
                <h1>Shop Reviews</h1>
            </header>

            <div class="reviews-summary">
                <h3>Review Summary</h3>
                <div class="review-details">
                    <div class="overall-rating">
                        <span class="rating-number">4.7</span>
                        <div class="stars">
                            <span class="star"><i class="fa-solid fa-star"></i></span>
                            <span class="star"><i class="fa-solid fa-star"></i></span>
                            <span class="star"><i class="fa-solid fa-star"></i></span>
                            <span class="star"><i class="fa-solid fa-star"></i></span>
                            <span class="star-half"><i class="fa-regular fa-star"></i></span>
                        </div>
                        <span class="total-reviews">(578 Reviews)</span>
                    </div>
    
                    <div class="rating-breakdown">
                        <div class="rating-bar">
                            <span>5 stars</span>
                            <div class="bar">
                                <div class="filled" style="width: 85%;"></div>
                            </div>
                            <span>488</span>
                        </div>
                        <div class="rating-bar">
                            <span>4 stars</span>
                            <div class="bar">
                                <div class="filled" style="width: 13%;"></div>
                            </div>
                            <span>74</span>
                        </div>
                        <div class="rating-bar">
                            <span>3 stars</span>
                            <div class="bar">
                                <div class="filled" style="width: 2%;"></div>
                            </div>
                            <span>14</span>
                        </div>
                        <div class="rating-bar">
                            <span>2 stars</span>
                            <div class="bar">
                                <div class="filled" style="width: 0%;"></div>
                            </div>
                            <span>0</span>
                        </div>
                        <div class="rating-bar">
                            <span>1 star</span>
                            <div class="bar">
                                <div class="filled" style="width: 0%;"></div>
                            </div>
                            <span>0</span>
                        </div>
                    </div>                
                </div>
            </div>

            <div class="individual-reviews">

                <div class="review">
                    <div class="review-header">
                        <span class="review-date">Jan 20, 2024</span>
                        <div class="stars">
                            <span class="star"><i class="fa-solid fa-star"></i></span>
                            <span class="star"><i class="fa-solid fa-star"></i></span>
                            <span class="star"><i class="fa-solid fa-star"></i></span>
                            <span class="star"><i class="fa-solid fa-star"></i></span>
                            <span class="star"><i class="fa-solid fa-star"></i></span>
                        </div>
                    </div>
    
                    <div class="review-body">
                        <div class="reviewer-info">
                            <span class="reviewer-avatar">AK</span>
                            <div class="reviewer-details">
                                <span class="reviewer-name">Alex K.</span>
                                <span class="reviewer-title">Senior Analyst</span>
                            </div>
                        </div>
                        <p class="review-text">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo est modi, vitae tempore quia asperiores tenetur facilis, ipsam temporibus mollitia nihil suscipit vero necessitatibus porro nostrum error. Corrupti, nulla voluptatibus!
                        </p>
                    </div>
                </div>
                <div class="review">
                    <div class="review-header">
                        <span class="review-date">Nov 13, 2023</span>
                        <div class="stars">
                            <span class="star"><i class="fa-solid fa-star"></i></span>
                            <span class="star"><i class="fa-solid fa-star"></i></span>
                            <span class="star"><i class="fa-solid fa-star"></i></span>
                            <span class="star"><i class="fa-solid fa-star"></i></span>
                            <span class="star"><i class="fa-solid fa-star"></i></span>
                        </div>
                    </div>
                    <div class="review-body">
                        <div class="reviewer-info">
                            <span class="reviewer-avatar">ER</span>
                            <div class="reviewer-details">
                                <span class="reviewer-name">Emily R.</span>
                                <span class="reviewer-title">Front-End Engineer</span>
                            </div>
                        </div>
                        <p class="review-text">
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Explicabo commodi quidem adipisci similique, deleniti consequuntur optio ipsum, quibusdam a inventore culpa esse nisi eius, ut soluta odio temporibus ad facilis magnam excepturi aut? Dolorem minima sed ut alias ipsum nemo.
                        </p>
                    </div>
                </div>
                <div class="review">
                    <div class="review-header">
                        <span class="review-date">Nov 7, 2023</span>
                        <div class="stars">
                            <span class="star"><i class="fa-solid fa-star"></i></span>
                            <span class="star"><i class="fa-solid fa-star"></i></span>
                            <span class="star"><i class="fa-solid fa-star"></i></span>
                            <span class="star"><i class="fa-solid fa-star"></i></span>
                            <span class="star"><i class="fa-solid fa-star"></i></span>
                        </div>
                    </div>
                    <div class="review-body">
                        <div class="reviewer-info">
                            <span class="reviewer-avatar">MT</span>
                            <div class="reviewer-details">
                                <span class="reviewer-name">Michael T.</span>
                                <span class="reviewer-title">Marketing Director</span>
                            </div>
                        </div>
                        <p class="review-text">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime placeat ullam magni? Laboriosam, maiores iusto distinctio consequatur omnis molestias eum corrupti accusamus illo sunt facilis quidem maxime, amet perspiciatis eius dicta dolorem nulla tempora ducimus cum velit. Eligendi, voluptate libero dolore amet voluptatibus laboriosam sint molestias corporis explicabo vitae officiis ducimus delectus maiores deleniti est suscipit ullam facilis debitis qui?
                    </div>
                </div>

                
            </div>

            <div class="pagination">
                <a href="#" class="active">1</a>
                <a href="#">2</a>
                <a href="#">3</i></a>
                <a href="#">...</a>
            </div>

        </main>

    </div>
    
    <script src="{{asset('js/Technician/5 - ShopReviews.js')}}"></script>
    <script src="{{asset('js/Technician/technician-sidebar.js')}}"></script>
</body>
</html>
