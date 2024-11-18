<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechXpertz</title>
    <link rel="icon" href="{{ asset('images/TechXpertz-Icon.ico') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('css/Technician/0 - Registration.css')}}">
    <link rel="stylesheet" href="{{asset('css/Technician/technician-notification.css')}}">
</head>
<body>

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

    <div class="Registration-Form">
        
        <div class="header">
            <div class="left">
                <h3>Tech<span>X</span>pertz</h3>
                <p>Technician</p>
            </div>
            <div class="right">
                <p>Need Help</p>
                <i class="fa-solid fa-question"></i>
            </div>
        </div>    
        
        <div class="body">
            <div class="form-container">
                <div class="form-navigation">
                    <h2>Registration Form</h2>
                    <ul>
                        <li class="nav-item active" data-step="1">Personal Information</li>
                        <li class="nav-item" data-step="2">Repair Shop Information</li>
                        <li class="nav-item" data-step="3">Terms and Conditions</li>
                        <li class="nav-item" data-step="4">Privacy Policy</li>
                        <li class="nav-item" data-step="5">Security</li>
                    </ul>
                </div>

                <form id="registrationForm" action="{{route('technician.signupTechnician')}}" method="POST"> 
                    @csrf
                    <div class="form-step active" data-step="1">
                        <div class="form-inputs">
                            <h2>Personal Information</h2>
                            <div class="input-container">
                                <div class="input-group">
                                    <label for="firstname">First Name</label>
                                    <input type="text" id="firstname" name="firstname" required>
                                </div>

                                <div class="input-group">
                                    <label for="middlename">Middle Name</label>
                                    <input type="text" id="middlename" name="middlename" required>
                                </div>
                                <div class="input-group">
                                    <label for="lastname">Last Name</label>
                                    <input type="text" id="lastname" name="lastname" required>
                                </div>
                                <div class="input-group">
                                    <label for="email">Email Address</label>
                                    <input type="email" id="email" name="email" required>
                                </div>
                                <div class="input-group">
                                    <label for="contact_no">Contact No.</label>
                                    <input type="tel" id="contact_no" name="contact_no" required>
                                </div>
                                <div class="input-group">
                                    <label for="educational_background">Educational Background</label>
                                    <input type="text" id="educational_background" name="educational_background">
                                </div>
                                <div class="input-group">
                                    <label for="province">Province</label>
                                    <select id="province" name="province" class="province" required>
                                        <option value=""></option>
                                    </select>
                                </div>
                                <div class="input-group">
                                    <label for="city_municipality">City or Municipality</label>
                                    <select id="city_municipality" name="city_municipality" class="city_municipality" required>
                                        <option value=""></option>
                                    </select>
                                </div>
                                <div class="input-group">
                                    <label for="barangay">Barangay</label>
                                    <select id="barangay" name="barangay" class="barangay" required>
                                        <option value=""></option>
                                    </select>
                                </div>
                                <div class="input-group">
                                    <label for="zip_code">ZIP Code</label>
                                    <input type="text" id="zip_code" name="zip_code" required>
                                </div>
                                <div class="input-group">
                                    <label for="date_of_birth">Date of Birth</label>
                                    <input type="date" id="date_of_birth" name="date_of_birth" required>
                                </div>                       
                            </div>                            
                        </div>
                        <div class="form-navigation-buttons">
                            <span></span>
                            <button type="button" class="next-btn">Next</button>
                        </div>
                    </div>

                    <div class="form-step" data-step="2">
                        <div class="form-inputs">
                            <h2>Repair Shop Information</h2>
                            <div class="input-container">
                                <div class="input-group">
                                    <label for="shop_name">Shop Name</label>
                                    <input type="text" id="shop_name" name="shop_name" required>
                                </div>
                                <div class="input-group">
                                    <label for="shop_email">Shop Email Address</label>
                                    <input type="email" id="shop_email" name="shop_email" required>
                                </div>
                                <div class="input-group">
                                    <label for="shop_contact">Business Contact No.</label>
                                    <input type="tel" id="shop_contact" name="shop_contact" required>
                                </div>
                                <div class="input-group">
                                    <label for="shop_address">Shop Address</label>
                                    <input type="tel" id="shop_address" name="shop_address" required>
                                </div>
                                <div class="input-group">
                                    <label for="shop_province">Province</label>
                                    <select id="shop_province" name="shop_province" class="shop_province" required>
                                        <option value=""></option>
                                    </select>
                                </div>
                                <div class="input-group">
                                    <label for="shop_city">City</label>
                                    <select id="shop_city" name="shop_city" class="shop_city" required>
                                        <option value=""></option>
                                    </select>
                                </div>
                                <div class="input-group">
                                    <label for="shop_barangay">Barangay</label>
                                    <select id="shop_barangay" name="shop_barangay" class="shop_barangay" required>
                                        <option value=""></option>
                                    </select>
                                </div>
                                <div class="input-group">
                                    <label for="shop_zip_code">ZIP Code</label>
                                    <input type="text" id="shop_zip_code" name="shop_zip_code" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-navigation-buttons">
                            <button type="button" class="prev-btn">Previous</button>
                            <button type="button" class="next-btn">Next</button>
                        </div>
                    </div>
                    
                    <div class="form-step" data-step="3">
                        <h2>Terms and Conditions</h2>
                        <div class="terms-condition">
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
                        <div class="form-navigation-buttons">
                            <button type="button" class="prev-btn">Previous</button>
                            <button type="button" class="next-btn">Next</button>
                        </div>
                    </div>

                    <div class="form-step" data-step="4">
                        <h2>Privacy Policy</h2>
                        <div class="terms-condition">
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
                        <div class="form-navigation-buttons">
                            <button type="button" class="prev-btn">Previous</button>
                            <button type="button" class="next-btn">Next</button>
                        </div>
                    </div>

                    <div class="form-step" data-step="5">
                        <h2>Security</h2>
                        <div class="security">
                            <div class="input-group">
                                <label for="email-preview">Email Address</label>
                                <input type="email-preview" id="email-preview" name="email-preview" required>
                            </div>
                            <div class="group-container">
                                <div class="input-group">
                                    <label for="password">Password</label>
                                    <input type="password" id="password" name="password" required>
                                </div>
                                <div class="input-group">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation" required>
                                </div>   
                            </div>
                             
                            <p>By creating an account, you agree to the <a href="">Terms of Service</a> and <a href="">Privacy Policy</a></p>
                        </div>
                        <div class="form-navigation-buttons">
                            <button type="button" class="prev-btn">Previous</button>
                            <button type="submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        // User location dropdown elements
        const provinceSelect = document.getElementById('province');
        const citySelect = document.getElementById('city_municipality');
        const barangaySelect = document.getElementById('barangay');

        // Shop location dropdown elements
        const shopProvinceSelect = document.getElementById('shop_province');
        const shopCitySelect = document.getElementById('shop_city');
        const shopBarangaySelect = document.getElementById('shop_barangay');

        let allCitiesMunicipalities = [];
        let allBarangays = [];

        // Fetch and populate provinces for both user and shop
        async function fetchProvinces() {
            try {
                const response = await fetch('https://psgc.gitlab.io/api/provinces.json');
                const provinces = await response.json();
                populateProvinces(provinces, provinceSelect);
                populateProvinces(provinces, shopProvinceSelect);
            } catch (error) {
                console.error("Error loading provinces:", error);
            }
        }

        // Populate provinces in a given select element
        function populateProvinces(provinces, selectElement) {
            provinces.forEach(province => {
                const option = document.createElement('option');
            option.value = province.name; // Set the province name as the value
                option.setAttribute('data-code', province.code); // Store the province code in data-code
                option.textContent = province.name; // Display the province name as text
                selectElement.appendChild(option);
            });
        }

        // Fetch and store cities/municipalities data
        async function fetchCitiesMunicipalities() {
            try {
                const response = await fetch('https://psgc.gitlab.io/api/cities-municipalities.json');
                allCitiesMunicipalities = await response.json();
            } catch (error) {
                console.error("Error loading cities:", error);
            }
        }

        // Filter and display cities based on selected province in the specified city dropdown
        function filterCitiesByProvince(provinceCode, citySelect, barangaySelect) {
            const filteredCities = allCitiesMunicipalities.filter(city => city.provinceCode === provinceCode);
            citySelect.innerHTML = '<option value="">Select City/Municipality</option>'; // Reset Provinces
            barangaySelect.innerHTML = '<option value="">Select Barangay</option>'; // Reset barangays

            filteredCities.forEach(city => {
                const option = document.createElement('option');
                option.value = city.name;                     // Set the city name as the value
                option.setAttribute('data-code', city.code);  // Store the city code in data-code
                option.textContent = city.name;               // Display the city name as text
                citySelect.appendChild(option);
            });
        }

        // Fetch and store barangays data
        async function fetchBarangays() {
            try {
                const response = await fetch('https://psgc.gitlab.io/api/barangays.json');
                allBarangays = await response.json();
            } catch (error) {
                console.error("Error loading barangays:", error);
            }
        }

        // Filter and display barangays based on selected city/municipality in the specified barangay dropdown
        function filterBarangays(cityMunicipalityCode, barangaySelect) {
            const filteredBarangays = allBarangays.filter(barangay =>
                barangay.cityCode === cityMunicipalityCode || barangay.municipalityCode === cityMunicipalityCode
            );
            barangaySelect.innerHTML = '<option value="">Select Barangay</option>';

            filteredBarangays.forEach(barangay => {
                const option = document.createElement('option');
                option.value = barangay.name;                  // Set the barangay name as the value
                option.setAttribute('data-code', barangay.code); // Store the barangay code in data-code
                option.textContent = barangay.name;            // Display the barangay name as text
                barangaySelect.appendChild(option);
            });
        }

        // Event Listeners for user location
        provinceSelect.addEventListener('change', function () {
            // Use the data-code to filter cities
            const selectedOption = provinceSelect.options[provinceSelect.selectedIndex];
            const provinceCode = selectedOption.getAttribute('data-code');
            filterCitiesByProvince(provinceCode, citySelect, barangaySelect);
        });
        citySelect.addEventListener('change', function () {
            const selectedOption = citySelect.options[citySelect.selectedIndex];
            const cityCode = selectedOption.getAttribute('data-code');
            filterBarangays(cityCode, barangaySelect);
        });

        // Event Listeners for shop location
        shopProvinceSelect.addEventListener('change', function () {
            const selectedOption = shopProvinceSelect.options[shopProvinceSelect.selectedIndex];
            const provinceCode = selectedOption.getAttribute('data-code');
            filterCitiesByProvince(provinceCode, shopCitySelect, shopBarangaySelect);
        });
        shopCitySelect.addEventListener('change', function () {
            const selectedOption = shopCitySelect.options[shopCitySelect.selectedIndex];
            const cityCode = selectedOption.getAttribute('data-code');
            filterBarangays(cityCode, shopBarangaySelect);
        });

        // Initial fetch calls
        fetchProvinces();
        fetchCitiesMunicipalities();
        fetchBarangays();
    </script>

    <script src="{{asset('js/Technician/0 - Registration.js')}}" defer></script>
    <script src="{{asset('js/Technician/technician-notification.js')}}" defer></script>
</body>
</html>
