@include('components.technician-sidebar')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('css/Technician/technician-sidebar.css')}}">

    <link rel="stylesheet" href="{{asset('css/Technician/1 - Dashboard.css')}}">
</head>
<body>
    <div class="dashboard">

        @yield('sidebar')

        <main class="main-content">
            <header>
                <h1>Dashboard</h1>
            </header>

            <section class="stats">
                <div class="stat revenue-card">
                    <div class="info">
                        <p>Revenue</p>
                        <h2>P35.2K</h2>
                    </div>
                    <div class="progress revenue">
                        <h4 class="percentage">+22%</h4>
                        <i class="fa-solid fa-arrow-trend-up"></i>
                    </div>
                </div>
                <div class="stat repairs-card">
                    <div class="info">
                        <p>Repairs</p>
                        <h2>58</h2>
                    </div>
                    <div class="progress repairs">
                        <h4 class="percentage">-25%</h4>
                        <i class="fa-solid fa-arrow-trend-down"></i>
                    </div>
                </div>
                <div class="stat visitors-card">
                    <div class="info">
                        <p>Visitors</p>
                        <h2>1.5K</h2>
                    </div>
                    <div class="progress visitors">
                        <h4 class="percentage">+49%</h4>
                        <i class="fa-solid fa-arrow-trend-up"></i>
                    </div>
                </div>
                <div class="stat reviews-card">
                    <div class="info">
                        <p>Reviews</p>
                        <h2>55</h2>
                    </div>
                    <div class="progress reviews">
                        <h4 class="percentage">+1.9%</h4>
                        <i class="fa-solid fa-arrow-trend-up"></i>
                    </div>
                </div>
            </section>
            
            <section class="appointments">
                <div class="appointments-requests card">
                    <div class="actions">
                        <h2>Appointment Requests</h2>
                        <a href="">More <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                    
                    <table>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Device Type</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>More</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="profile-cell"> Hazel Nutt</td>
                                <td>Laptop</td>
                                <td>29/04/24</td>
                                <td>10AM</td>
                                <td><button>View</button></td>
                            </tr>
                            <tr>
                                <td class="profile-cell"> Chris P. Bacon</td>
                                <td>Speaker</td>
                                <td>02/05/24</td>
                                <td>12PM</td>
                                <td><button>View</button></td>
                            </tr>
                            <tr>
                                <td class="profile-cell"> Marsha Mellow</td>
                                <td>Desktop</td>
                                <td>03/05/24</td>
                                <td>3PM</td>
                                <td><button>View</button></td>
                            </tr>
                            <tr>
                                <td class="profile-cell"> Aida Bugg</td>
                                <td>Laptop</td>
                                <td>06/05/24</td>
                                <td>9AM</td>
                                <td><button>View</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="appointment-summary card">
                    <div class="actions">
                        <h2>Activity Summary</h2>
                        <a href="">More <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                    <div class="summary-cards">
                        <div class="summary-card">
                            <div class="info">
                                <p>Upcoming</p>
                                <h2>7</h2>                                
                            </div>
                            <i class="fa-solid fa-calendar-day upcoming"></i>
                        </div>
                        <div class="summary-card">
                            <div class="info">
                                <p>Requests</p>
                                <h2>25</h2>                                
                            </div>
                            <i class="fa-solid fa-calendar-plus request"></i>
                        </div>
                        <div class="summary-card">
                            <div class="info">
                                <p>Pending Repairs</p>
                                <h2>5</h2>                                
                            </div>
                            <i class="fa-solid fa-screwdriver-wrench pending"></i>
                        </div>
                        <div class="summary-card">
                            <div class="info">
                                <p>Completed Repairs</p>
                                <h2>4</h2>                                
                            </div>
                            <i class="fa-solid fa-check-double completed"></i>
                        </div>
                    </div>
                </div>
            </section>

            <section class="upcoming-appointments card">
                <div class="actions">
                    <h2>Upcoming Appointments</h2>
                    <a href="">More <i class="fa-solid fa-arrow-right"></i></a>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Details</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Chris P. Bacon</td>
                            <td>chrispbacon@gmail.com</td>
                            <td>04567890231</td>
                            <td>April 30, 2024</td>
                            <td>8AM - 9AM</td>
                            <td><button>View</button></td>
                            <td>
                                <a class="edit" href=""><i class="fas fa-edit"></i></a>
                                <a class="delete" href=""><i class="fas fa-trash"></i></a>
                                <a class="more" href=""><i class="fa-solid fa-ellipsis"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>Chris P. Bacon</td>
                            <td>chrispbacon@gmail.com</td>
                            <td>04567890231</td>
                            <td>May 30, 2024</td>
                            <td>8AM - 9AM</td>
                            <td><button>View</button></td>
                            <td>
                                <a class="edit" href=""><i class="fas fa-edit"></i></a>
                                <a class="delete" href=""><i class="fas fa-trash"></i></a>
                                <a class="more" href=""><i class="fa-solid fa-ellipsis"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>Chris P. Bacon</td>
                            <td>chrispbacon@gmail.com</td>
                            <td>04567890231</td>
                            <td>May 30, 2024</td>
                            <td>8AM - 9AM</td>
                            <td><button>View</button></td>
                            <td>
                                <a class="edit" href=""><i class="fas fa-edit"></i></a>
                                <a class="delete" href=""><i class="fas fa-trash"></i></a>
                                <a class="more" href=""><i class="fa-solid fa-ellipsis"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>Chris P. Bacon</td>
                            <td>chrispbacon@gmail.com</td>
                            <td>04567890231</td>
                            <td>May 30, 2024</td>
                            <td>8AM - 9AM</td>
                            <td><button>View</button></td>
                            <td>
                                <a class="edit" href=""><i class="fas fa-edit"></i></a>
                                <a class="delete" href=""><i class="fas fa-trash"></i></a>
                                <a class="more" href=""><i class="fa-solid fa-ellipsis"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>Chris P. Bacon</td>
                            <td>chrispbacon@gmail.com</td>
                            <td>04567890231</td>
                            <td>May 30, 2024</td>
                            <td>8AM - 9AM</td>
                            <td><button>View</button></td>
                            <td>
                                <a class="edit" href=""><i class="fas fa-edit"></i></a>
                                <a class="delete" href=""><i class="fas fa-trash"></i></a>
                                <a class="more" href=""><i class="fa-solid fa-ellipsis"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </section>
        </main>
    </div>
    
    <script src="{{asset('js/Technician/technician-sidebar.js')}}"></script>
</body>
</html>
