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
    <link rel="stylesheet" href="{{asset('css/Technician/technician-modal.css')}}">
</head>
<body>
    <div class="dashboard">

    <div class="modal" id="modal">

    </div>

        @yield('sidebar')

        <main class="main-content">

            <header>
                <h1>Manage Profile</h1>
            </header>

            <form class="manage-profile" action="{{route('technician.updateProfile')}}" method="POST">
                @csrf
                <section class="form-section fs-1">
                    <h3><span>1</span>Basic Information</h3>
                    <div class="form-details">
                        <div class="form-group">
                            <label for="shop_name">Shop Name</label>
                            <input type="text" id="shop_name" name="shop_name" value="{{$repairshopInfo->shop_name}}" required>
                        </div>
                        <div class="form-group">
                            <label for="owner_name">Owner's Name</label>
                            <input type="text" id="owner_name" name="owner_name" value="{{$technicianInfo->firstname}}" required>
                        </div>
                        <div class="form-group">
                            <label for="shop_contact">Contact No.</label>
                            <input type="text" id="shop_contact" name="shop_contact" value="{{$repairshopInfo->shop_contact}}" required>
                        </div>
                        <div class="form-group">
                            <label for="shop_email">Email</label>
                            <input type="email" id="shop_email" name="shop_email" value="{{$repairshopInfo->shop_email}}" required>
                        </div>                        
                    </div>
                </section>

                <section class="form-section fs-1">
                    <h3><span>2</span>Shop Location</h3>
                    <div class="form-details">
                        <div class="form-group">
                            <label for="shop_province">Province</label>
                            <input type="text" id="shop_province" name="shop_province" value="{{$repairshopInfo->shop_province}}">
                        </div>
                        <div class="form-group">
                            <label for="shop_city">City</label>
                            <input type="text" id="shop_city" name="shop_city" value="{{$repairshopInfo->shop_city}}">
                        </div>
                        <div class="form-group">
                            <label for="shop_barangay">Barangay</label>
                            <input type="text" id="shop_barangay" name="shop_barangay" value="{{$repairshopInfo->shop_barangay}}">
                        </div>
                        <div class="form-group">
                            <label for="shop_address">Address</label>
                            <input type="text" id="shop_address" name="shop_address" value="{{$repairshopInfo->shop_address}}">
                        </div>                        
                    </div>
                </section>

                <section class="form-section fs-1">
                    <h3><span>3</span>Shop Badges</h3>
                    <div class="form-details">
                        <div class="form-group">
                            <label for="badge_1">Badge 1</label>
                            <select name="badge_1" id="badge_1" data-saved-value="{{ $technicianBadges->badge_1 ?? '' }}">
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="badge_2">Badge 2</label>
                            <select name="badge_2" id="badge_2" data-saved-value="{{ $technicianBadges->badge_2 ?? '' }}">
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="badge_3">Badge 3</label>
                            <select name="badge_3" id="badge_3" data-saved-value="{{ $technicianBadges->badge_3 ?? '' }}">
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="badge_4">Badge 4</label>
                            <select name="badge_4" id="badge_4" data-saved-value="{{ $technicianBadges->badge_4 ?? '' }}">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                </section>

                <section class="form-section fs-3">
                    <h3><span>3</span> Specialization</h3>
                    <div class="form-group">
                        @foreach(['Smartphone', 'Tablet', 'Desktop', 'Laptop', 'Smartwatch', 'Camera', 'Printer', 'Speaker', 'Drone', 'All-In-One'] as $item)
                            <div class="form-details {{ $technicianMastery && $technicianMastery->$item ? 'active' : '' }}">
                                <input type="checkbox" class="checkbox-input" name="{{ $item }}" id="{{ $item }}" hidden {{ $technicianMastery && $technicianMastery->$item ? 'checked' : '' }}>
                                <i class="fa-solid fa-desktop"></i>
                                <p>{{ $item }}</p>
                            </div>
                        @endforeach
                    </div>
                </section>

                <section class="form-section fs-4 services-section">
                    <h3><span>4</span>Services</h3>
                    <div class="form-details">
                        @foreach($technicianServices as $service)
                            <div class="form-group">
                                <label for="service">Service {{ $loop->iteration }}</label>
                                <textarea type="text" id="service" name="service[]">{{$service->service}}</textarea>
                            </div>
                        @endforeach
                        <button type="button" class="add-service"><i class="fa-solid fa-plus"></i>Add Service</button>
                    </div>
                </section>

                <section class="form-section fs-5">
                    <h3><span>5</span>Opening Hours</h3>

                    <table class="opening-hours-input">
                        <tbody>
                            @php
                                $daysOfWeek = [
                                    7 => 'sunday',
                                    1 => 'monday',
                                    2 => 'tuesday',
                                    3 => 'wednesday',
                                    4 => 'thursday',
                                    5 => 'friday',
                                    6 => 'saturday',
                                ];
                            @endphp

                            @foreach($technicianSchedules as $schedule)
                                @php
                                    $dayName = $daysOfWeek[$schedule->day];
                                    $isChecked = $schedule->status === 'open' ? 'checked' : '';

                                    // Retrieve formatted times from the array
                                    $openingTime = $formattedTimes[$dayName]['open'] ?? '';
                                    $closingTime = $formattedTimes[$dayName]['close'] ?? '';
                                @endphp
                                <tr>
                                    <td>{{ ucfirst($dayName) }}</td>
                                    <td>
                                        <div class="status">
                                            <label class="switch">
                                                <input type="checkbox" id="{{ $dayName }}-status" name="{{ $dayName }}-status" {{ $isChecked }}>
                                                <span class="slider round"></span>
                                            </label>
                                            <p>{{ $schedule->status === 'open' ? 'Open' : 'Closed' }}</p>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="time">
                                            <input type="time" id="{{ $dayName }}-open-time" name="{{ $dayName }}-open-time" value="{{ $openingTime }}">
                                            <label>TO</label>
                                            <input type="time" id="{{ $dayName }}-close-time" name="{{ $dayName }}-close-time" value="{{ $closingTime }}">
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                </section>

                <section class="form-section fs-6">
                    <h3><span>6</span>About</h3>

                    <div class="form-group">
                        <label for="header">Header</label>
                        <textarea id="header" name="header">{{$technicianProfile->header ?? '' }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" name="description">{{$technicianProfile->description ?? '' }}</textarea>
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
    <script src="{{asset('js/Technician/technician-modal.js')}}"></script>
    <script>
        const formDetails = document.querySelectorAll('.form-details');

        formDetails.forEach(detail => {
            detail.addEventListener('click', () => {
                const checkbox = detail.querySelector('.checkbox-input');
                checkbox.checked = !checkbox.checked;

                // Toggle the 'active' class based on the checkbox state
                if (checkbox.checked) {
                    detail.classList.add('active');
                } else {
                    detail.classList.remove('active');
                }
            });
        });

        //-----------------------------------------------------------------

        document.addEventListener('DOMContentLoaded', function() {
            // Select the specific Services section
            const servicesSection = document.querySelector('.services-section');
            const addServiceButton = servicesSection.querySelector('.add-service');
            const formDetails = servicesSection.querySelector('.form-details');

            addServiceButton.addEventListener('click', function() {
                // Get the current number of service groups within this section
                const currentServiceCount = formDetails.querySelectorAll('.form-group').length;
                const newServiceCount = currentServiceCount + 1;
                
                if (currentServiceCount <= 4) {
                    // Create a new form group
                    const newFormGroup = document.createElement('div');
                    newFormGroup.classList.add('form-group');

                    // Create and append the label
                    const newLabel = document.createElement('label');
                    newLabel.setAttribute('for', `service${newServiceCount}`);
                    newLabel.textContent = `Service ${newServiceCount}`;
                    newFormGroup.appendChild(newLabel);

                    // Create and append the textarea
                    const newTextarea = document.createElement('textarea');
                    newTextarea.type = 'text';
                    newTextarea.id = `service${newServiceCount}`;
                    newTextarea.name = `service[]`; // Use an array name to handle multiple inputs in backend
                    newFormGroup.appendChild(newTextarea);

                    // Append the new form group to the form details
                    formDetails.insertBefore(newFormGroup, addServiceButton);                    
                }

            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Get all checkbox inputs
            const checkboxes = document.querySelectorAll('.opening-hours-input input[type="checkbox"]');

            // Loop through each checkbox and add an event listener
            checkboxes.forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    // Find the corresponding <p> tag in the same row
                    const statusText = this.closest('td').querySelector('.status p');
                    
                    // Update the text based on the checkbox state
                    if (this.checked) {
                        statusText.textContent = 'Open';
                    } else {
                        statusText.textContent = 'Closed';
                    }
                });
            });
        });
        //-----------------------------------------------------------------
        var toggle = document.getElementById("sunday-status");
        if(toggle.checked){
            console.log('toggled');
        }
        
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const saveprofileBtn = document.querySelector('button.save-btn');
        
            saveprofileBtn.addEventListener('click', function (e){
                e.preventDefault();
                verifySaveChanges();
            });

            function verifySaveChanges(){
                const modal = document.getElementById('modal');

                modal.innerHTML = `
                <div class="form">
                    <div class="modal-verification">
                        <i class="fa-solid fa-circle-check" id="repair"></i>
                        <div class="verification-message">
                            <h2>Confirm Save Changes</h2>
                            <p>Are you sure you want to save these changes?</p>
                        </div>
                        <div class="verification-action">
                            <button type="submit" class="submit" id="save-changes">Save Changes</button>
                            <button type="button" class="normal"><b>Dismiss</b></button>
                        </div>
                    </div>                
                </div>
                `;

                document.getElementById('save-changes').addEventListener('click', function(){
                    document.querySelector('form.manage-profile').submit();
                });

                // Show the modal
                modal.classList.add("active");

                // Close modal when 'X' is clicked
                document.querySelector('.normal').onclick = function () {
                    modal.classList.remove("active");
                };
            }
        });
    </script>
</body>
</html>
