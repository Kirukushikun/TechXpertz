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
    <link rel="stylesheet" href="{{asset('css/Technician/technician-notification.css')}}">
</head>
<body>
    <div class="dashboard">

        <!-- PUSH NOTIFICATION -->
        @if(session()->has('error'))
            <div class="push-notification danger active">
                <i class="fa-solid fa-bell danger"></i>
                <div class="notification-message">
                    <h4>Appointment Booked</h4>
                    <p>{{session('error')}}</p>
                </div>
                <i class="fa-solid fa-xmark" id="close-notification"></i>
            </div>
        @elseif(session()->has('success'))
            <div class="push-notification success active">
                <i class="fa-solid fa-bell success"></i>
                <div class="notification-message">
                    <h4>{{session('success')}}</h4>
                    <p>{{session('success_message')}}</p>
                </div>
                <i class="fa-solid fa-xmark" id="close-notification"></i>
            </div>
        @endif

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
                        <label for="mastery">Main Mastery</label>
                        @php
                            $savedValue = $technicianMastery->main_mastery ?? '';
                        @endphp
                        <select name="mastery" id="mastery" required>
                            <option value="" @if(empty($savedValue)) selected @endif></option>
                            <option value="Smartphone" @if($savedValue === 'Smartphone') selected @endif>Smartphone</option>
                            <option value="Tablet" @if($savedValue === 'Tablet') selected @endif>Tablet</option>
                            <option value="Desktop" @if($savedValue === 'Desktop') selected @endif>Desktop</option>
                            <option value="Laptop" @if($savedValue === 'Laptop') selected @endif>Laptop</option>
                            <option value="Smartwatch" @if($savedValue === 'Smartwatch') selected @endif>Smartwatch</option>
                            <option value="Camera" @if($savedValue === 'Camera') selected @endif>Camera</option>
                            <option value="Printer" @if($savedValue === 'Printer') selected @endif>Printer</option>
                            <option value="Speaker" @if($savedValue === 'Speaker') selected @endif>Speaker</option>
                            <option value="Drone" @if($savedValue === 'Drone') selected @endif>Drone</option>
                            <option value="All-In-One" @if($savedValue === 'All-In-One') selected @endif>All-In-One</option>
                        </select>
                        <br>
                    </div>
                    <div class="form-group">
                        @foreach(['Smartphone', 'Tablet', 'Desktop', 'Laptop', 'Smartwatch', 'Camera', 'Printer', 'Speaker', 'Drone', 'All-In-One'] as $item)
                            <div class="form-details {{ $technicianMastery && $technicianMastery->$item ? 'active' : '' }}">
                                <input type="checkbox" class="checkbox-input" name="{{ $item }}" id="{{ $item }}" hidden {{ $technicianMastery && $technicianMastery->$item ? 'checked' : '' }}>
                                    <img src="{{asset('images/' . $item . '.png')}}">
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
    <script src="{{asset('js/Technician/technician-notification.js')}}"></script>

</body>
</html>
