@include('components.admin-sidebar')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="stylesheet" href="{{ asset('css/Admin/6 - ViewProfile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Admin/admin-sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Admin/admin-modal.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="dashboard">

        <div class="modal">

        </div>

        @yield('sidebar')

        <main class="main-content">
            <div class="head">
                <div class="logo">
                    <h2>Tech<span>X</span>pertz</h2>
                </div>

                @yield('navbar')

            </div>
            
            <div class="body">
                <!-- <div class="header">
                    <h1>View Profile</h1>
                </div> -->
                <!-- <div class="content">
                </div> -->
                <div class="content">
                    <div class="left">
                        <div class="upper">
                            <div class="profile-navigation">
                                <h2>User Profile</h2>
                                <ul>
                                    <li><a href="#" data-target="technician-details" class="active">Technician Details</a></li>
                                    <li><a href="#" data-target="repair-shop-profile">Repair Shop Profile</a></li>
                                    <li><a href="#" data-target="compliance-documents">Compliance & Documentation</a></li>
                                    <li><a href="#" data-target="repair-monitoring">Repair Monitoring</a></li>
                                    <li><a href="#" data-target="appointment-monitoring">Appointment Monitoring</a></li>
                                    <li><a href="#" data-target="ratings-feedback">Ratings & Feedback</a></li>
                                    <li><a href="#" data-target="disciplinary-records">Disciplinary Records</a></li>
                                    <li><a href="#" data-target="access-logs">Access Logs</a></li>
                                </ul>
                            </div>                            
                        </div>
                    </div>

                    <div class="right">
                        <div id="technician-details" class="form-container active">
                            <div class="form-header">
                                <div class="profile-detail">
                                    <div class="image"></div>
                                    <div class="details">
                                        <h3>Bruno Mars</h3>
                                        <p>brunomars@gmail.com</p> 
                                        <span>Verified</span>                               
                                    </div>
                                </div>
                                
                                <div class="profile-action">
                                    <button class="submit">View picture</button>
                                    <button class="normal">Delete picture</button>
                                </div>
                            </div>

                            <div class="form-section col-3">
                                <div class="form-group">
                                    <label for="user-ID">ID</label>
                                    <input type="text" id="user-ID" name="user-ID" value="" required>
                                </div>
                                <div class="form-group">
                                    <label for="first-name">First Name</label>
                                    <input type="text" id="first-name" name="first-name" value="" required>
                                </div>
                                <div class="form-group">
                                    <label for="middle-name">Middle Name</label>
                                    <input type="text" id="middle-name" name="middle-name" value="" required>
                                </div> 
                                <div class="form-group">
                                    <label for="last-name">Last Name</label>
                                    <input type="text" id="last-name" name="last-name" value="" required>
                                </div> 

                                <div class="form-group">
                                    <label for="email-address">Email Address</label>
                                    <input type="text" id="email-address" name="email-address" value="" required>
                                </div>
                                <div class="form-group">
                                    <label for="contact-no">Contact No.</label>
                                    <input type="text" id="contact-no" name="contact-no" value="" required>
                                </div>
                                <div class="form-group">
                                    <label for="educational-bg">Educational Background</label>
                                    <input type="text" id="educational-bg" name="educational-bg" value="" required>
                                </div>

                                <div class="form-group">
                                    <label for="province">Province</label>
                                    <input type="text" id="province" name="province" value="" required>
                                </div>
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <input type="text" id="city" name="city" value="" required>
                                </div>
                                <div class="form-group">
                                    <label for="barangay">Barangay</label>
                                    <input type="text" id="barangay" name="barangay" value="" required>
                                </div>

                                <div class="form-group">
                                    <label for="ZIP-code">ZIP Code</label>
                                    <input type="text" id="ZIP-code" name="ZIP-code" value="" required>
                                </div>
                            </div>
                        </div>

                        <div id="repair-shop-profile" class="form-container">
                            <div class="form-header">
                                <h2>Repair Shop Credentials</h2>
                            </div>

                            <div class="form-section col-3">
                                <div class="form-group">
                                    <label for="first-name">Shop Name</label>
                                    <input type="text" id="first-name" name="first-name" value="" required>
                                </div>
                                <div class="form-group">
                                    <label for="middle-name">Middle Name</label>
                                    <input type="text" id="middle-name" name="middle-name" value="" required>
                                </div> 
                                <div class="form-group">
                                    <label for="last-name">Last Name</label>
                                    <input type="text" id="last-name" name="last-name" value="" required>
                                </div> 

                                <div class="form-group">
                                    <label for="email-address">Email Address</label>
                                    <input type="text" id="email-address" name="email-address" value="" required>
                                </div>
                                <div class="form-group">
                                    <label for="contact-no">Contact No.</label>
                                    <input type="text" id="contact-no" name="contact-no" value="" required>
                                </div>
                                <div class="form-group">
                                    <label for="educational-bg">Educational Background</label>
                                    <input type="text" id="educational-bg" name="educational-bg" value="" required>
                                </div>

                                <div class="form-group">
                                    <label for="province">Province</label>
                                    <input type="text" id="province" name="province" value="" required>
                                </div>
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <input type="text" id="city" name="city" value="" required>
                                </div>
                                <div class="form-group">
                                    <label for="barangay">Barangay</label>
                                    <input type="text" id="barangay" name="barangay" value="" required>
                                </div>

                                <div class="form-group">
                                    <label for="ZIP-code">ZIP Code</label>
                                    <input type="text" id="ZIP-code" name="ZIP-code" value="" required>
                                </div>
                            </div>

                            <div class="form-header">
                                <h2>Repair Shop Profile</h2>
                            </div>
                            <div class="line">
                                <h3>REPAIR SHOP BADGES</h3>
                                <div class="lines"> </div>
                            </div>
                            <div class="form-section col-4">
                                <div class="form-group">
                                    <label for="first-name">Badge 1</label>
                                    <input type="text" id="first-name" name="first-name" value="" required>
                                </div>
                                <div class="form-group">
                                    <label for="middle-name">Badge 2</label>
                                    <input type="text" id="middle-name" name="middle-name" value="" required>
                                </div> 
                                <div class="form-group">
                                    <label for="last-name">Badge 3</label>
                                    <input type="text" id="last-name" name="last-name" value="" required>
                                </div> 

                                <div class="form-group">
                                    <label for="email-address">Badge 4</label>
                                    <input type="text" id="email-address" name="email-address" value="" required>
                                </div>
                            </div>

                            <div class="line">
                                <h3>REPAIR SHOP MASTERY</h3>
                                <div class="lines"> </div>
                            </div>

                            <div class="form-group">
                                <label for="ZIP-code">Main Mastery</label>
                                <input type="text" id="ZIP-code" name="ZIP-code" value="" required>
                            </div>


                            <div class="line">
                                <h3>REPAIR SHOP repairS</h3>
                                <div class="lines"> </div>
                            </div>

                            <div class="form-section col-2">
                                <div class="form-group">
                                    <label for="ZIP-code">Service 1</label>
                                    <input type="text" id="ZIP-code" name="ZIP-code" value="" required>
                                </div>

                                <div class="form-group">
                                    <label for="ZIP-code">Service 2</label>
                                    <input type="text" id="ZIP-code" name="ZIP-code" value="" required>
                                </div>

                                <div class="form-group">
                                    <label for="ZIP-code">Service 3</label>
                                    <input type="text" id="ZIP-code" name="ZIP-code" value="" required>
                                </div>

                                <div class="form-group">
                                    <label for="ZIP-code">Service 4</label>
                                    <input type="text" id="ZIP-code" name="ZIP-code" value="" required>
                                </div>

                                <div class="form-group">
                                    <label for="ZIP-code">Service 5</label>
                                    <input type="text" id="ZIP-code" name="ZIP-code" value="" required>
                                </div>
                            </div>

                            <div class="line">
                                <h3>REPAIR SHOP SCHEDULE</h3>
                                <div class="lines"> </div>
                            </div>

                            <div class="form-section col-3">
                                <div class="form-group">
                                    <label for="ZIP-code">Monday</label>
                                    <input type="text" id="ZIP-code" name="ZIP-code" value="" required>
                                </div>
                                <div class="form-group">
                                    <label for="ZIP-code">Tuesday</label>
                                    <input type="text" id="ZIP-code" name="ZIP-code" value="" required>
                                </div>
                                <div class="form-group">
                                    <label for="ZIP-code">Wednesday</label>
                                    <input type="text" id="ZIP-code" name="ZIP-code" value="" required>
                                </div>
                                <div class="form-group">
                                    <label for="ZIP-code">Thursday</label>
                                    <input type="text" id="ZIP-code" name="ZIP-code" value="" required>
                                </div>
                                <div class="form-group">
                                    <label for="ZIP-code">Friday</label>
                                    <input type="text" id="ZIP-code" name="ZIP-code" value="" required>
                                </div>
                                <div class="form-group">
                                    <label for="ZIP-code">Saturday</label>
                                    <input type="text" id="ZIP-code" name="ZIP-code" value="" required>
                                </div>
                                <div class="form-group">
                                    <label for="ZIP-code">Sunday</label>
                                    <input type="text" id="ZIP-code" name="ZIP-code" value="" required>
                                </div>
                            </div>

                            <div class="line">
                                <h3>REPAIR SHOP ABOUT</h3>
                                <div class="lines"> </div>
                            </div>

                            <div class="form-group">
                                <label for="ZIP-code">Header</label>
                                <input type="text" id="ZIP-code" name="ZIP-code" value="" required>
                            </div>
                            <div class="form-group">
                                <label for="ZIP-code">Description</label>
                                <textarea type="text" id="ZIP-code" name="ZIP-code" value="" required></textarea>
                            </div>
                        </div>

                        <div id="compliance-documents" class="form-container">
                            <div class="form-header">
                                <h2>Compliance & Documentation</h2>
                            </div>
                        </div>

                        <div id="compliance-documents" class="form-container">
                            <div class="form-header">
                                <h2>Compliance & Documentation</h2>
                            </div>
                        </div>

                        <div id="repair-monitoring" class="form-container">
                            <div class="form-header">
                                <h2>Repair Monitoring</h2>

                                <div class="tab-filters">
                                    <li><button><i class="fa-solid fa-filter"></i> Filter</button></li>
                                    <li><i class="fa-solid fa-magnifying-glass" id="search"></i> <input type="text" placeholder="search"></li>
                                </div>
                            </div>

                            <table>
                                <thead>
                                    <tr>
                                        <th>Repair ID</th>
                                        <th>Customer Name</th>
                                        <th>Status</th>
                                        <th>Repair Status</th>
                                        <th>Revenue</th>
                                        <th>Date Updated</th>
                                        <th>Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><button class="view-details" data-appointment-id="">View</button></td>
                                        </tr>
                                </tbody>
                            </table>
                        </div>

                        <div id="appointment-monitoring" class="form-container">
                            <div class="form-header">
                                <h2>Appointment Monitoring</h2>
                                <div class="tab-filters">
                                    <li><button><i class="fa-solid fa-filter"></i> Filter</button></li>
                                    <li><i class="fa-solid fa-magnifying-glass" id="search"></i> <input type="text" placeholder="search"></li>
                                </div>
                            </div>

                            <table>
                                <thead>
                                    <tr>
                                        <th>Appointment ID</th>
                                        <th>Customer Name</th>
                                        <th>Status</th>
                                        <th>Date Requested</th>
                                        <th>Time Requested</th>
                                        <th>Date Updated</th>
                                        <th>Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><button class="view-details" data-appointment-id="">View</button></td>
                                        </tr>
                                </tbody>
                            </table>
                        </div>

                        <div id="ratings-feedback" class="form-container">
                            <div class="form-header">
                                <h2>Ratings & Feedback</h2>
                            </div>
                        </div>

                        <div id="disciplinary-records" class="form-container">
                            <div class="form-header">
                                <h2>Disciplinary Records</h2>
                            </div>
                        </div>

                        <div id="access-logs" class="form-container">
                            <div class="form-header">
                                <h2>Access Logs</h2>
                            </div>
                        </div>
                    </div>                    
                </div>

            </div>
        </main>
    </div>

    <script src="{{ asset('js/Admin/2 - UserManagement.js') }}"></script>
    <script src="{{ asset('js/Admin/admin-navbars.js') }}"></script>
    <script src="{{ asset('js/Admin/admin-modal.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const links = document.querySelectorAll('.profile-navigation a');
            const sections = document.querySelectorAll('.right .form-container');

            // Add event listeners to each navigation link
            links.forEach(link => {
                link.addEventListener('click', function (event) {
                    event.preventDefault();

                    // Remove the 'active' class from all links
                    links.forEach(link => link.classList.remove('active'));

                    // Add the 'active' class to the clicked link
                    this.classList.add('active');

                    // Hide all sections
                    sections.forEach(section => section.classList.remove("active"));

                    // Show the corresponding section
                    const sectionId = this.getAttribute('data-target');
                    document.getElementById(sectionId).classList.add("active");
                });
            });
        });
    </script>
</body>
</html>
