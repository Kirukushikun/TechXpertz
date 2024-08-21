@include('components.technician-sidebar')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('css/Technician/technician-sidebar.css')}}">

    <link rel="stylesheet" href="{{asset('css/Technician/6 - ManageProfile.css')}}">
</head>
<body>
    <div class="dashboard">

        @yield('sidebar')

        <main class="main-content">
            <header>
                <h1>Manage Profile</h1>
            </header>

            <form>
                <section class="form-section fs-1">
                    <h3><span>1</span>Basic Information</h3>
                    <div class="form-details">
                        <div class="form-group">
                            <label for="shop-name">Shop Name</label>
                            <input type="text" id="shop-name" name="shop-name">
                        </div>
                        <div class="form-group">
                            <label for="owner-name">Owner's Name</label>
                            <input type="text" id="owner-name" name="owner-name">
                        </div>
                        <div class="form-group">
                            <label for="contact-no">Contact No.</label>
                            <input type="text" id="contact-no" name="contact-no">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email">
                        </div>                        
                    </div>
                </section>

                <section class="form-section fs-1">
                    <h3><span>2</span>Shop Location</h3>
                    <div class="form-details">
                        <div class="form-group">
                            <label for="province">Province</label>
                            <input type="text" id="province" name="province">
                        </div>
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" id="city" name="city">
                        </div>
                        <div class="form-group">
                            <label for="barangay">Barangay</label>
                            <input type="text" id="barangay" name="barangay">
                        </div>
                        <div class="form-group">
                            <label for="street">Street</label>
                            <input type="text" id="street" name="street">
                        </div>                        
                    </div>
                </section>

                <section class="form-section fs-1">
                    <h3><span>3</span>Shop Badges</h3>
                    <div class="form-details">
                        <div class="form-group">
                            <label for="badge_1">Badge 1</label>
                            <select name="badge_1" id="badge_1">
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="badge_2">Badge 2</label>
                            <select name="badge_2" id="badge_2">
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="badge_3">Badge 3</label>
                            <select name="badge_3" id="badge_3">
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="badge_4">Badge 4</label>
                            <select name="badge_4" id="badge_4">
                                <option value=""></option>
                            </select>
                        </div>                        
                    </div>
                </section>

                <section class="form-section fs-3">
                    <h3><span>3</span> Specialization</h3>
                    <div class="form-group">
                        <div class="form-details">
                            <i class="fa-solid fa-desktop"></i>
                            <p>Speakers</p>
                        </div>
                        <div class="form-details">
                            <i class="fa-solid fa-desktop"></i>
                            <p>Smartphones</p>
                        </div>
                        <div class="form-details">
                            <i class="fa-solid fa-desktop"></i>
                            <p>Laptop</p>
                        </div>
                        <div class="form-details">
                            <i class="fa-solid fa-desktop"></i>
                            <p>Desktop</p>
                        </div>
                        <button type="button" class="add-btn"><i class="fa-solid fa-plus"></i></button>
                    </div>
                </section>

                <section class="form-section fs-4">
                    <h3><span>4</span>Services</h3>
                    <div class="form-details">
                        <div class="form-group">
                            <label for="province">Service 1</label>
                            <textarea type="text" id="province" name="province"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="city">Service 2</label>
                            <textarea type="text" id="city" name="city"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="barangay">Service 3</label>
                            <textarea type="text" id="barangay" name="barangay"></textarea>
                        </div>
                        <button type="button" class="add-btn"><i class="fa-solid fa-plus"></i></button>
                    </div>
                </section>

                <section class="form-section fs-5">
                    <h3><span>5</span>Opening Hours</h3>

                    <table class="opening-hours-input">
                        <tbody>
                            <tr>
                                <td>Sunday</td>
                                <td>
                                    <div class="status">
                                        <label class="switch">
                                            <input type="checkbox" id="sunday-open">
                                            <span class="slider round"></span>
                                        </label>
                                        <p>Closed</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="time">
                                        <input type="time" id="sunday-open-time" name="sunday-open" value="09:00">
                                        <label for="sunday-close">TO</label>
                                        <input type="time" id="sunday-close" name="sunday-close" value="17:00">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Monday</td>
                                <td>
                                    <div class="status">
                                        <label class="switch">
                                            <input type="checkbox" id="monday-open">
                                            <span class="slider round"></span>
                                        </label>
                                        <p>Closed</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="time">
                                        <input type="time" id="monday-open-time" name="monday-open" value="09:00">
                                        <label for="monday-close">TO</label>
                                        <input type="time" id="monday-close" name="monday-close" value="17:00">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Tuesday</td>
                                <td>
                                    <div class="status">
                                        <label class="switch">
                                            <input type="checkbox" id="tuesday-open">
                                            <span class="slider round"></span>
                                        </label>
                                        <p>Closed</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="time">
                                        <input type="time" id="tuesday-open-time" name="tuesday-open" value="09:00">
                                        <label for="tuesday-close">TO</label>
                                        <input type="time" id="tuesday-close" name="tuesday-close" value="17:00">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Wednesday</td>
                                <td>
                                    <div class="status">
                                        <label class="switch">
                                            <input type="checkbox" id="wednesday-open">
                                            <span class="slider round"></span>
                                        </label>
                                        <p>Closed</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="time">
                                        <input type="time" id="wednesday-open-time" name="wednesday-open" value="09:00">
                                        <label for="wednesday-close">TO</label>
                                        <input type="time" id="wednesday-close" name="wednesday-close" value="17:00">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Thursday</td>
                                <td>
                                    <div class="status">
                                        <label class="switch">
                                            <input type="checkbox" id="thursday-open">
                                            <span class="slider round"></span>
                                        </label>
                                        <p>Closed</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="time">
                                        <input type="time" id="thursday-open-time" name="thursday-open" value="09:00">
                                        <label for="thursday-close">TO</label>
                                        <input type="time" id="thursday-close" name="thursday-close" value="17:00">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Friday</td>
                                <td>
                                    <div class="status">
                                        <label class="switch">
                                            <input type="checkbox" id="friday-open">
                                            <span class="slider round"></span>
                                        </label>
                                        <p>Closed</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="time">
                                        <input type="time" id="friday-open-time" name="friday-open" value="09:00">
                                        <label for="friday-close">TO</label>
                                        <input type="time" id="friday-close" name="friday-close" value="17:00">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Saturday</td>
                                <td>
                                    <div class="status">
                                        <label class="switch">
                                            <input type="checkbox" id="saturday-open">
                                            <span class="slider round"></span>
                                        </label>
                                        <p>Closed</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="time">
                                        <input type="time" id="saturday-open-time" name="saturday-open" value="09:00">
                                        <label for="saturday-close">TO</label>
                                        <input type="time" id="saturday-close" name="saturday-close" value="17:00">
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    
                </section>

                <section class="form-section fs-6">
                    <h3><span>6</span>About</h3>

                    <div class="form-group">
                        <label for="about-header">Header</label>
                        <textarea id="about-header" name="about-header"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="about-description">Description</label>
                        <textarea id="about-description" name="about-description"></textarea>
                    </div>
                </section>

                <div class="form-actions">
                    <button type="button" class="cancel-btn">Cancel</button>
                    <button type="button" class="live-preview-btn">Live Preview</button>
                    <button type="submit" class="save-btn">Save Changes</button>
                </div>    
            </form>

        </main>

    </div>
    
    <script src="{{asset('js/Technician/6 - ManageProfile.js')}}"></script>
    <script src="{{asset('js/Technician/technician-sidebar.js')}}"></script>
    <script>
        // Function to populate select inputs with options
        function populateSelectInputs() {
            const badges = [
                "24/7 Customer Support",
                "Advanced Diagnostic Tools",
                "Authorized Repair Center",
                "Certified Technicians On-Site",
                "Emergency Repair Service",
                "Exclusive Offers Available",
                "Experienced Staff",
                "Expert Troubleshooting",
                "Fastest Repair Times",
                "Free Diagnostic Service",
                "Loyalty Rewards Program",
                "No Hidden Charges",
                "Original Parts Used",
                "Pickup and Delivery Service",
                "Proven Repair Methods",
                "Same-Day Service",
                "Seamless Repair Process",
                "Secure Data Handling",
                "Specialized in All Brands",
                "Warranty on All Repairs"
            ];

            const selectIds = ["badge_1", "badge_2", "badge_3", "badge_4"];

            selectIds.forEach(id => {
                const select = document.getElementById(id);

                // Preserve the existing selected value
                const savedValue = select.value;

                // Clear existing options
                select.innerHTML = '';

                // Add an empty option at the top
                const emptyOption = document.createElement("option");
                emptyOption.value = '';
                emptyOption.textContent = '';
                select.appendChild(emptyOption);

                // Add each badge as an option
                badges.forEach(badge => {
                    const option = document.createElement("option");
                    option.value = badge;
                    option.textContent = badge;

                    // Set the saved value as selected if it matches
                    if (badge === savedValue) {
                        option.selected = true;
                    }

                    select.appendChild(option);
                });

                // If there's no pre-selected value and one exists in the original HTML, select it
                if (savedValue === "" && select.querySelector('option[selected]')) {
                    select.value = select.querySelector('option[selected]').value;
                }
            });
        }

        // Call the function to populate the select inputs when the page loads
        populateSelectInputs();

    </script>
</body>
</html>
