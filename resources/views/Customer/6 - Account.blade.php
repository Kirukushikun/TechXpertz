@include('components.header-footer')
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>TechXpertz</title>
        <link rel="icon" href="{{ asset('images/TechXpertz-Icon.ico') }}">
        <!-- Crucial Part on every forms -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Crucial Part on every forms/ -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        
        <link rel="stylesheet" href="{{ asset('css/Customer/customer-headerfooter.css') }}">
        <link rel="stylesheet" href="{{ asset('css/Customer/customer-loadingscreen.css') }}">
        <link rel="stylesheet" href="{{ asset('css/Customer/customer-modal.css') }}">
        <link rel="stylesheet" href="{{ asset('css/Customer/customer-notification.css') }}">

        <link rel="stylesheet" href="{{ asset('css/Customer/6 - Account.css') }}">
    </head>
    <body id="main-body">

        @if(session()->has('error'))
            <div class="push-notification danger active">
                <i class="fa-solid fa-bell danger"></i>
                <div class="notification-message">
                    <h4>{{session('error')}}</h4>
                    <p>{{session('error_message')}}</p>
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

        <div class="loading-screen">
            <div class="loader"></div>
        </div>

        <div class="modal" id="modal">

        </div>

        @yield('header')    

        <div class="account-form">
            <div class="right">
                <div class="upper">
                    <div class="profile-navigation">
                        <h2>Settings</h2>
                        <ul>
                            <li><a href="#" data-target="account-settings" class="active">Account Settings</a></li>
                            <li><a href="#" data-target="notifications">Notifications</a></li>
                            <li><a href="#" data-target="privacy-policy">Privacy Policy</a></li>
                            <li><a href="#" data-target="terms-of-service">Terms of Service</a></li>
                            <li><a href="#" data-target="delete-account">Delete Account</a></li>
                        </ul>
                    </div>                                        
                </div>

                <button class="logout-button" onclick="window.location.href='{{route('customer.logoutCustomer')}}'">LOG OUT</button>
            </div>

            <div class="right-collapse">
                <div class="profile-detail">
                    @if($customerData->image_profile)
                        <div class="image" style="background-image: url('{{ asset($customerData->image_profile) }}');"></div>
                    @else
                        <div class="image"></div>
                    @endif
                    <div class="details">
                        <h3>{{$customerData->firstname}} {{$customerData->lastname}}</h3>
                        <p>{{$customerData->email}}</p>                                
                    </div>
                </div>
                <div class="profile-navigation">
                    <ul>
                        <li>
                            <a href="#" data-target="account-settings" class="active"><i class="fa-solid fa-user-gear"></i><p>Account Settings</p></a>
                        </li>
                        <li>
                            <a href="#" data-target="notifications"><i class="fa-solid fa-bell"></i><p>Account Notifications</p></a>
                        </li>
                        <li>
                            <a href="#" data-target="privacy-policy"><i class="fa-solid fa-user-shield"></i><p>Privacy Policy</p></a>
                        </li>
                        <li>
                            <a href="#" data-target="terms-of-service"><i class="fa-solid fa-file-circle-check"></i><p>Terms of Service</p></a>
                        </li>
                        <li>
                            <a href="#" data-target="delete-account"><i class="fa-solid fa-user-minus"></i><p>Delete Account</p></a>
                        </li>
                    </ul>
                </div>
            </div>
        
            <div class="left">
                <form action="{{ route('customer.updateprofile', ['actionType' => 'update', 'customerID' => $customerData->id]) }}" id="account-settings" class="form-section" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="profile-container">
                        <div class="profile-detail">
                            @if($customerData->image_profile)
                                <div class="image" style="background-image: url('{{ asset($customerData->image_profile) }}');"></div>
                            @else
                                <div class="image"></div>
                            @endif
                            <div class="details">
                                <h3>{{$customerData->firstname}} {{$customerData->lastname}}</h3>
                                <p>{{$customerData->email}}</p>                                
                            </div>
                        </div>
                        
                        <div class="profile-action">
                            @if($customerData->image_profile)
                            <button type="button" class="upload-image submit" data-customer-id="{{$customerData->id}}" data-action="upload">Change picture</button>
                            @else
                            <button type="button" class="upload-image submit" data-customer-id="{{$customerData->id}}" data-action="upload">Upload picture</button>
                            @endif
                            <button type="button" class="upload-image normal" data-customer-id="{{$customerData->id}}" data-action="delete">Delete picture</button>
                        </div>
                    </div>

                    <div class="profile-action-collapse">
                        @if($customerData->image_profile)
                        <button type="button" class="upload-image submit" data-customer-id="{{$customerData->id}}" data-action="upload">Change picture</button>
                        @else
                        <button type="button" class="upload-image submit" data-customer-id="{{$customerData->id}}" data-action="upload">Upload picture</button>
                        @endif
                        <button type="button" class="upload-image normal" data-customer-id="{{$customerData->id}}" data-action="delete">Delete picture</button>
                    </div>

                    <div class="form-container">
                        
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" id="first_name" name="first_name" value="{{$customerData->firstname}}" required>
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" id="last_name" name="last_name" value="{{$customerData->lastname}}" required>
                        </div>                        
                    </div>

                    <div class="form-container">
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" value="{{$customerData->email}}" required>
                        </div>
                        <div class="form-group">
                            <label for="contact">Mobile Phone Number</label>
                            <input type="tel" id="contact" name="contact" value="{{$customerData->contact}}" required>
                        </div>                        
                    </div>

                    <div class="line">
                        <div class="lines"> </div>
                        <h3>CHANGE PASSWORD</h3>
                        <div class="lines"> </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="current_password">Current Password</label>
                        <input type="password" id="current_password" name="current_password">
                    </div>  
                                      
                    <div class="form-container">
                        <div class="form-group">
                            <label for="new_password">New Password</label>
                            <input type="password" id="new_password" name="new_password">
                        </div>
                        <div class="form-group">
                            <label for="new_password_confirmation">Confirm New Password</label>
                            <input type="password" id="new_password_confirmation" name="new_password_confirmation">
                        </div>                        
                    </div>
                    
                    <div id="form-action" class="form-action">
                        <button type="submit" class="submit-btn submit">SAVE CHANGES</button>
                    </div>
                    
                </form>

                <div id="notifications" class="form-section">
                    <h2>Notifications</h2>

                    @if($notifications->isNotEmpty())
                        @foreach($notifications as $notification)
                            <div class="notification">
                                <div class="notification-header">
                                    <div class="left-header">
                                        <div class="notification-icon">
                                            <i class="fa-solid fa-bell"></i>
                                        </div>
                                        <div class="notification-details">
                                            <span class="notification-title">{{$notification->title}}</span>
                                            <span class="notification-date">{{ $notification->created_at->format('M d, Y, h:i A') }}</span>
                                        </div>                        
                                    </div>
                                    <div class="right-header">
                                        <div class="notification-action">
                                            @if($notification->is_read)
                                                <button style="color: #999" disabled>
                                                    <i class="fa-solid fa-envelope-open-text"></i>Marked as Read
                                                </button>
                                            @else
                                                <button class="submit" data-notification-id="{{$notification->id}}" type="submit" style="cursor:pointer;">
                                                    <i class="fa-solid fa-envelope"></i>Mark as Read
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>


                                <div class="notification-body">
                                    <div class="notification-message">
                                        <p>
                                            {{$notification->message}}
                                        </p>
                                    </div>
                                    <div class="notification-checklist">
                                        <!-- OPTIONAL CONTAINER -->
                                    </div>
                                </div>
                            </div>
                        @endforeach 
                    @else
                        <div class="empty">
                            <i class="fa-solid fa-bell"></i>
                            <p>You have no notifications yet</p>
                        </div>                    
                    @endif
                </div>

                <div id="privacy-policy" class="form-section">
                    <h2>Privacy Policy</h2>
                    <div class="section">
                        <h3>General Terms</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vehicula dui eu urna tincidunt, ac bibendum nisi sollicitudin. Mauris ut tortor et magna gravida vestibulum.</p>
                    </div>
                    <div class="section">
                        <h3>License</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse potenti. Cras bibendum, sapien eu lacinia vehicula, neque turpis varius magna, vel sollicitudin felis mauris nec nisl.</p>
                    </div>
                    <div class="section">
                        <h3>Definitions and Key Terms</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer euismod, leo vel malesuada lacinia, orci nulla efficitur nulla, sit amet tincidunt nulla erat non sapien.</p>
                    </div>
                    <div class="section">
                        <h3>Restrictions</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ac eros vel magna vehicula fermentum. Curabitur dictum purus vitae ligula sollicitudin fringilla. Donec nec erat nec mi dapibus tincidunt.</p>
                    </div>
                    <div class="section">
                        <h3>Payment Return and Refund Policy</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus a libero eget nisi vehicula convallis sit amet non tortor.</p>
                    </div>
                    <div class="section">
                        <h3>Your Suggestions</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer lacinia, velit ac porttitor vehicula, nulla lacus bibendum nulla, at vestibulum turpis leo sit amet sapien. Suspendisse potenti.</p>
                    </div>
                    <div class="section">
                        <h3>Your Consent</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec nec erat nec mi dapibus tincidunt.</p>
                    </div>
                    <div class="section">
                        <h3>Link to Other Websites</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus a libero eget nisi vehicula convallis sit amet non tortor. Sed vehicula augue a ligula gravida, a tincidunt dui pulvinar.</p>
                    </div>
                    <div class="section">
                        <h3>Cookies</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce scelerisque metus sit amet ultricies bibendum. Morbi vitae ligula sit amet libero venenatis commodo.</p>
                    </div>
                    <div class="section">
                        <h3>Changes To Our Terms & Conditions</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur et orci at odio consectetur blandit. Donec nec felis lorem. Phasellus a urna eu odio consequat hendrerit.</p>
                    </div>
                    <div class="section">
                        <h3>Modifications to Our Service</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut auctor massa nec ante gravida, sit amet cursus dui condimentum.</p>
                    </div>
                    <div class="section">
                        <h3>Updates to Our Service</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam et sapien ut justo faucibus elementum.</p>
                    </div>
                    <div class="section">
                        <h3>Third-Party Services</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vehicula dui eu urna tincidunt, ac bibendum nisi sollicitudin. Mauris ut tortor et magna gravida vestibulum.</p>
                    </div>
                    <div class="section">
                        <h3>Term and Termination</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse potenti. Cras bibendum, sapien eu lacinia vehicula, neque turpis varius magna, vel sollicitudin felis mauris nec nisl.</p>
                    </div>
                    <div class="section">
                        <h3>Copyright Infringement Notice</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer euismod, leo vel malesuada lacinia, orci nulla efficitur nulla, sit amet tincidunt nulla erat non sapien.</p>
                    </div>
                    <div class="section">
                        <h3>Indemnification</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ac eros vel magna vehicula fermentum. Curabitur dictum purus vitae ligula sollicitudin fringilla. Donec nec erat nec mi dapibus tincidunt.</p>
                    </div>
                    <div class="section">
                        <h3>No Warranties</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus a libero eget nisi vehicula convallis sit amet non tortor.</p>
                    </div>
                    <div class="section">
                        <h3>Limitation of Liability</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer lacinia, velit ac porttitor vehicula, nulla lacus bibendum nulla, at vestibulum turpis leo sit amet sapien. Suspendisse potenti.</p>
                    </div>
                    <div class="section">
                        <h3>Severability</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec nec erat nec mi dapibus tincidunt.</p>
                    </div>
                    <div class="section">
                        <h3>Waiver</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus a libero eget nisi vehicula convallis sit amet non tortor. Sed vehicula augue a ligula gravida, a tincidunt dui pulvinar.</p>
                    </div>
                    <div class="section">
                        <h3>Amendments to this Agreement</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce scelerisque metus sit amet ultricies bibendum. Morbi vitae ligula sit amet libero venenatis commodo.</p>
                    </div>
                    <div class="section">
                        <h3>Entire Agreement</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur et orci at odio consectetur blandit. Donec nec felis lorem. Phasellus a urna eu odio consequat hendrerit.</p>
                    </div>
                    <div class="section">
                        <h3>Updates to Our Terms</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut auctor massa nec ante gravida, sit amet cursus dui condimentum.</p>
                    </div>
                    <div class="section">
                        <h3>Intellectual Property</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam et sapien ut justo faucibus elementum.</p>
                    </div>
                    <div class="section">
                        <h3>Agreement to Arbitrate</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vehicula dui eu urna tincidunt, ac bibendum nisi sollicitudin. Mauris ut tortor et magna gravida vestibulum.</p>
                    </div>
                    <div class="section">
                        <h3>Notice of Dispute</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse potenti. Cras bibendum, sapien eu lacinia vehicula, neque turpis varius magna, vel sollicitudin felis mauris nec nisl.</p>
                    </div>
                    <div class="section">
                        <h3>Binding Arbitration</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer euismod, leo vel malesuada lacinia, orci nulla efficitur nulla, sit amet tincidunt nulla erat non sapien.</p>
                    </div>
                    <div class="section">
                        <h3>Submissions and Privacy</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ac eros vel magna vehicula fermentum. Curabitur dictum purus vitae ligula sollicitudin fringilla. Donec nec erat nec mi dapibus tincidunt.</p>
                    </div>
                    <div class="section">
                        <h3>Promotions</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus a libero eget nisi vehicula convallis sit amet non tortor.</p>
                    </div>
                    <div class="section">
                        <h3>Typographical Errors</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer lacinia, velit ac porttitor vehicula, nulla lacus bibendum nulla, at vestibulum turpis leo sit amet sapien. Suspendisse potenti.</p>
                    </div>
                    <div class="section">
                        <h3>Miscellaneous</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec nec erat nec mi dapibus tincidunt.</p>
                    </div>
                    <div class="section">
                        <h3>Disclaimer</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus a libero eget nisi vehicula convallis sit amet non tortor. Sed vehicula augue a ligula gravida, a tincidunt dui pulvinar.</p>
                    </div>
                    <div class="section">
                        <h3>Contact Us</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut auctor massa nec ante gravida, sit amet cursus dui condimentum.</p>
                    </div>
                </div>

                <div id="terms-of-service" class="form-section">
                    <h2>Terms of Service</h2>
                    <div class="section">
                        <h3>General Terms</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vehicula dui eu urna tincidunt, ac bibendum nisi sollicitudin. Mauris ut tortor et magna gravida vestibulum.</p>
                    </div>
                    <div class="section">
                        <h3>License</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse potenti. Cras bibendum, sapien eu lacinia vehicula, neque turpis varius magna, vel sollicitudin felis mauris nec nisl.</p>
                    </div>
                    <div class="section">
                        <h3>Definitions and Key Terms</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer euismod, leo vel malesuada lacinia, orci nulla efficitur nulla, sit amet tincidunt nulla erat non sapien.</p>
                    </div>
                    <div class="section">
                        <h3>Restrictions</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ac eros vel magna vehicula fermentum. Curabitur dictum purus vitae ligula sollicitudin fringilla. Donec nec erat nec mi dapibus tincidunt.</p>
                    </div>
                    <div class="section">
                        <h3>Payment Return and Refund Policy</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus a libero eget nisi vehicula convallis sit amet non tortor.</p>
                    </div>
                    <div class="section">
                        <h3>Your Suggestions</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer lacinia, velit ac porttitor vehicula, nulla lacus bibendum nulla, at vestibulum turpis leo sit amet sapien. Suspendisse potenti.</p>
                    </div>
                    <div class="section">
                        <h3>Your Consent</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec nec erat nec mi dapibus tincidunt.</p>
                    </div>
                    <div class="section">
                        <h3>Link to Other Websites</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus a libero eget nisi vehicula convallis sit amet non tortor. Sed vehicula augue a ligula gravida, a tincidunt dui pulvinar.</p>
                    </div>
                    <div class="section">
                        <h3>Cookies</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce scelerisque metus sit amet ultricies bibendum. Morbi vitae ligula sit amet libero venenatis commodo.</p>
                    </div>
                    <div class="section">
                        <h3>Changes To Our Terms & Conditions</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur et orci at odio consectetur blandit. Donec nec felis lorem. Phasellus a urna eu odio consequat hendrerit.</p>
                    </div>
                    <div class="section">
                        <h3>Modifications to Our Service</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut auctor massa nec ante gravida, sit amet cursus dui condimentum.</p>
                    </div>
                    <div class="section">
                        <h3>Updates to Our Service</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam et sapien ut justo faucibus elementum.</p>
                    </div>
                    <div class="section">
                        <h3>Third-Party Services</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vehicula dui eu urna tincidunt, ac bibendum nisi sollicitudin. Mauris ut tortor et magna gravida vestibulum.</p>
                    </div>
                    <div class="section">
                        <h3>Term and Termination</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse potenti. Cras bibendum, sapien eu lacinia vehicula, neque turpis varius magna, vel sollicitudin felis mauris nec nisl.</p>
                    </div>
                    <div class="section">
                        <h3>Copyright Infringement Notice</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer euismod, leo vel malesuada lacinia, orci nulla efficitur nulla, sit amet tincidunt nulla erat non sapien.</p>
                    </div>
                    <div class="section">
                        <h3>Indemnification</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ac eros vel magna vehicula fermentum. Curabitur dictum purus vitae ligula sollicitudin fringilla. Donec nec erat nec mi dapibus tincidunt.</p>
                    </div>
                    <div class="section">
                        <h3>No Warranties</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus a libero eget nisi vehicula convallis sit amet non tortor.</p>
                    </div>
                    <div class="section">
                        <h3>Limitation of Liability</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer lacinia, velit ac porttitor vehicula, nulla lacus bibendum nulla, at vestibulum turpis leo sit amet sapien. Suspendisse potenti.</p>
                    </div>
                    <div class="section">
                        <h3>Severability</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec nec erat nec mi dapibus tincidunt.</p>
                    </div>
                    <div class="section">
                        <h3>Waiver</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus a libero eget nisi vehicula convallis sit amet non tortor. Sed vehicula augue a ligula gravida, a tincidunt dui pulvinar.</p>
                    </div>
                    <div class="section">
                        <h3>Amendments to this Agreement</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce scelerisque metus sit amet ultricies bibendum. Morbi vitae ligula sit amet libero venenatis commodo.</p>
                    </div>
                    <div class="section">
                        <h3>Entire Agreement</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur et orci at odio consectetur blandit. Donec nec felis lorem. Phasellus a urna eu odio consequat hendrerit.</p>
                    </div>
                    <div class="section">
                        <h3>Updates to Our Terms</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut auctor massa nec ante gravida, sit amet cursus dui condimentum.</p>
                    </div>
                    <div class="section">
                        <h3>Intellectual Property</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam et sapien ut justo faucibus elementum.</p>
                    </div>
                    <div class="section">
                        <h3>Agreement to Arbitrate</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vehicula dui eu urna tincidunt, ac bibendum nisi sollicitudin. Mauris ut tortor et magna gravida vestibulum.</p>
                    </div>
                    <div class="section">
                        <h3>Notice of Dispute</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse potenti. Cras bibendum, sapien eu lacinia vehicula, neque turpis varius magna, vel sollicitudin felis mauris nec nisl.</p>
                    </div>
                    <div class="section">
                        <h3>Binding Arbitration</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer euismod, leo vel malesuada lacinia, orci nulla efficitur nulla, sit amet tincidunt nulla erat non sapien.</p>
                    </div>
                    <div class="section">
                        <h3>Submissions and Privacy</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ac eros vel magna vehicula fermentum. Curabitur dictum purus vitae ligula sollicitudin fringilla. Donec nec erat nec mi dapibus tincidunt.</p>
                    </div>
                    <div class="section">
                        <h3>Promotions</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus a libero eget nisi vehicula convallis sit amet non tortor.</p>
                    </div>
                    <div class="section">
                        <h3>Typographical Errors</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer lacinia, velit ac porttitor vehicula, nulla lacus bibendum nulla, at vestibulum turpis leo sit amet sapien. Suspendisse potenti.</p>
                    </div>
                    <div class="section">
                        <h3>Miscellaneous</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec nec erat nec mi dapibus tincidunt.</p>
                    </div>
                    <div class="section">
                        <h3>Disclaimer</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus a libero eget nisi vehicula convallis sit amet non tortor. Sed vehicula augue a ligula gravida, a tincidunt dui pulvinar.</p>
                    </div>
                    <div class="section">
                        <h3>Contact Us</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut auctor massa nec ante gravida, sit amet cursus dui condimentum.</p>
                    </div>
                </div>

                <div id="delete-account" class="form-section">
                    <div class="form-content">
                        <h2>Delete Account</h2>
                        <p>Permanently delete your account. This action is irreversible. All of your data, including your profile, messages, and settings, will be permanently deleted. You will not be able to recover your account once it has been deleted.</p>
                        <ul>
                            <li><strong>Permanent Data Loss:</strong> All of your account data, including posts, messages, settings, and any ongoing or past service history, will be permanently deleted.</li>
                            <li><strong>No Account Recovery:</strong> Once your account is deleted, you will lose all access and will need to create a new account to use our services again.</li>
                            <li><strong>Upcoming or Ongoing Appointments:</strong> If you have any upcoming or ongoing appointments with a repair shop or technician, or an ongoing repair service, account deletion will not proceed. Please complete or cancel all active services before attempting to delete your account.</li>
                        </ul>                          
                    </div>

                    <div class="delete-action" id="delete-action">
                        <button class="submit-btn danger" id="delete-account-btn" data-customer-id="{{Auth::user()->id}}">DELETE ACCOUNT</button>
                    </div>
                </div>
            </div>
        </div>


        @yield('footer')

    </body>

    <script src="{{asset('js/Customer/6 - Account.js')}}" defer></script>
    <script src="{{asset('js/Customer/customer-notification.js')}}" defer></script>
    <script src="{{asset('js/Customer/header-footer.js')}}" defer></script>
    <script src="{{asset('js/Customer/customer-loadingscreen.js')}}" defer></script>
</html>