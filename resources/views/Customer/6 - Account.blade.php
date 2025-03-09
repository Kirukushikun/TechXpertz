@include('components.header-footer')
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>TechXpertz</title>
        <link rel="icon" href="{{ asset('images/TechXpertz-Icon.ico') }}" />
        <!-- Crucial Part on every forms -->
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <!-- Crucial Part on every forms/ -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <link rel="stylesheet" href="{{ asset('css/Customer/customer-headerfooter.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/Customer/customer-loadingscreen.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/Customer/customer-modal.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/Customer/customer-notification.css') }}" />

        <link rel="stylesheet" href="{{ asset('css/Customer/6 - Account.css') }}" />
    </head>
    <body id="main-body">
        @if(session()->has('error'))
        <div class="push-notification danger">
            <i class="fa-solid fa-bell danger"></i>
            <div class="notification-message">
                <h4>{{session('error')}}</h4>
                <p>{{session('error_message')}}</p>
            </div>
            <i class="fa-solid fa-xmark" id="close-notification"></i>
        </div>
        @elseif(session()->has('success'))
        <div class="push-notification success">
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

        <div class="modal" id="modal"></div>

        @yield('header')

        <div class="account-form">
            <div class="right">
                <div class="upper">
                    <div class="profile-navigation">
                        <h2>Settings</h2>
                        <ul>
                            <li><a href="#" data-target="account-settings" class="active">Account Settings</a></li>
                            <li>
                                <a href="#" data-target="notifications">Notifications {!! $hasUnreadNotifications ? '<i class="fa-solid fa-circle"></i>' : '' !!} </a>
                            </li>
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
                            <a href="#" data-target="account-settings" class="active"
                                ><i class="fa-solid fa-user-gear"></i>
                                <p>Account Settings</p></a
                            >
                        </li>
                        <li>
                            <a href="#" data-target="notifications"
                                ><i class="fa-solid fa-bell"></i>
                                <p>Account Notifications</p></a
                            >
                        </li>
                        <li>
                            <a href="#" data-target="privacy-policy"
                                ><i class="fa-solid fa-user-shield"></i>
                                <p>Privacy Policy</p></a
                            >
                        </li>
                        <li>
                            <a href="#" data-target="terms-of-service"
                                ><i class="fa-solid fa-file-circle-check"></i>
                                <p>Terms of Service</p></a
                            >
                        </li>
                        <li>
                            <a href="#" data-target="delete-account"
                                ><i class="fa-solid fa-user-minus"></i>
                                <p>Delete Account</p></a
                            >
                        </li>
                    </ul>
                </div>
            </div>

            <div class="left">
                <form action="{{ route('customer.updateprofile', ['actionType' => 'update', 'customerID' => $customerData->id]) }}" id="account-settings" class="form-section" method="POST">
                    @csrf @method('PATCH')
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
                            <button type="button" class="upload-image normal" data-customer-id="{{$customerData->id}}" data-action="delete">Delete picture</button>
                            @else
                            <button type="button" class="upload-image submit" data-customer-id="{{$customerData->id}}" data-action="upload">Upload picture</button>
                            @endif
                        </div>
                    </div>

                    <div class="profile-action-collapse">
                        @if($customerData->image_profile)
                        <button type="button" class="upload-image submit" data-customer-id="{{$customerData->id}}" data-action="upload">Change picture</button>
                        <button type="button" class="upload-image normal" data-customer-id="{{$customerData->id}}" data-action="delete">Delete picture</button>
                        @else
                        <button type="button" class="upload-image submit" data-customer-id="{{$customerData->id}}" data-action="upload">Upload picture</button>
                        @endif
                    </div>

                    <div class="form-container">
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" id="first_name" name="first_name" value="{{$customerData->firstname}}" required />
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" id="last_name" name="last_name" value="{{$customerData->lastname}}" required />
                        </div>
                    </div>

                    <div class="form-container">
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" value="{{$customerData->email}}" required />
                        </div>
                        <div class="form-group">
                            <label for="contact">Mobile Phone Number</label>
                            <input type="number" id="contact" name="contact" value="{{$customerData->contact}}" required />
                        </div>
                    </div>

                    <div class="line">
                        <div class="lines"></div>
                        <h3>CHANGE PASSWORD</h3>
                        <div class="lines"></div>
                    </div>

                    <div class="form-group">
                        <label for="current_password">Current Password</label>
                        <input type="password" id="current_password" name="current_password" />
                    </div>

                    <div class="form-container">
                        <div class="form-group">
                            <label for="new_password">New Password</label>
                            <input type="password" id="new_password" name="new_password" />
                        </div>
                        <div class="form-group">
                            <label for="new_password_confirmation">Confirm New Password</label>
                            <input type="password" id="new_password_confirmation" name="new_password_confirmation" />
                        </div>
                    </div>

                    <div id="form-action" class="form-action">
                        <button type="submit" class="submit-btn submit">SAVE CHANGES</button>
                    </div>
                </form>

                <div id="notifications" class="form-section">
                    <h2>Notifications</h2>

                    @if($allNotifications->isNotEmpty()) @foreach($allNotifications as $notification)
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
                                    @if($notification->target_id) @if($notification->is_read)
                                    <button style="color: #999" disabled><i class="fa-solid fa-envelope-open-text"></i>Marked as Read</button>
                                    @else
                                    <button class="submit" data-notification-id="{{$notification->id}}" type="submit" style="cursor: pointer"><i class="fa-solid fa-envelope"></i>Mark as Read</button>
                                    @endif @endif
                                </div>
                            </div>
                        </div>

                        <div class="notification-body">
                            <div class="notification-message">
                                <p>{{$notification->message}}</p>
                            </div>
                            <div class="notification-checklist">
                                <!-- OPTIONAL CONTAINER -->
                            </div>
                        </div>
                    </div>
                    @endforeach @else
                    <div class="empty">
                        <i class="fa-solid fa-bell"></i>
                        <p>You have no notifications yet</p>
                    </div>
                    @endif
                </div>

                <div id="privacy-policy" class="form-section">
                    <div class="section">
                        <p><strong>Effective Date:</strong> November 19, 2024</p>
                        <p><strong>Last Updated:</strong> November 19, 2024</p>
                        <p>At <strong>TechXpertz</strong>, accessible from <a href="https://techxpertz.tech">https://techxpertz.tech</a>, we value your privacy and are committed to protecting your personal information. This Privacy Policy outlines how we collect, use, and safeguard your information when you use our platform. By accessing our website, you consent to the terms described in this Privacy Policy.</p>
                    </div>

                    <div class="section">
                        <h2>1. Information We Collect</h2>
                        <h3>1.1 Personal Information</h3>
                        <ul>
                            <li>Name</li>
                            <li>Email address</li>
                            <li>Phone number</li>
                            <li>Device details for repair</li>
                            <li>Account credentials (username and password)</li>
                        </ul>
                        <h3>1.2 Non-Personal Information</h3>
                        <ul>
                            <li>Browser type and version</li>
                            <li>Device type (e.g., desktop, mobile)</li>
                            <li>IP address</li>
                            <li>Website usage data, including pages visited and time spent</li>
                        </ul>
                    </div>

                    <div class="section">
                        <h2>2. How We Use Your Information</h2>
                        <ul>
                            <li>Provide and improve our services, including repair shop connections.</li>
                            <li>Facilitate user interactions, such as appointment bookings and communication with technicians.</li>
                            <li>Send service updates, notifications, or promotional content (with your consent).</li>
                            <li>Improve platform functionality and user experience through analytics.</li>
                            <li>Ensure platform security and prevent unauthorized activities.</li>
                        </ul>
                    </div>

                    <div class="section">
                        <h2>3. Sharing Your Information</h2>
                        <p>We respect your privacy and only share your information under the following circumstances:</p>
                        <ul>
                            <li><strong>With Service Providers:</strong> We work with third-party vendors to assist with analytics, email services, and troubleshooting.</li>
                            <li><strong>Legal Compliance:</strong> We may share your information to comply with applicable laws, court orders, or governmental regulations.</li>
                            <li><strong>Business Transactions:</strong> In the event of a merger, acquisition, or sale, your data may be transferred to the new entity.</li>
                        </ul>
                        <p>We do not sell your personal information to third parties.</p>
                    </div>

                    <div class="section">
                        <h2>4. Data Retention</h2>
                        <p>We retain your personal information only as long as necessary to fulfill the purposes outlined in this Privacy Policy or comply with legal obligations.</p>
                        <ul>
                            <li><strong>Account Information:</strong> Retained until the account is deleted or as required by law.</li>
                            <li><strong>Service Data:</strong> Retained to resolve disputes or for troubleshooting purposes.</li>
                        </ul>
                    </div>

                    <div class="section">
                        <h2>5. Cookies and Tracking Technologies</h2>
                        <p>We use cookies and similar technologies to enhance user experience. These include:</p>
                        <ul>
                            <li><strong>Session Cookies:</strong> To maintain your login and browsing session.</li>
                            <li><strong>Analytics Cookies:</strong> To gather insights on website performance and usage patterns.</li>
                        </ul>
                        <p>You can disable cookies in your browser settings, though some features of the platform may not function as intended.</p>
                    </div>

                    <div class="section">
                        <h2>6. Your Rights</h2>
                        <p>Depending on your location, you may have the following rights regarding your personal data:</p>
                        <ul>
                            <li><strong>Access:</strong> Request access to the personal data we hold about you.</li>
                            <li><strong>Correction:</strong> Update or correct inaccurate or incomplete data.</li>
                            <li><strong>Deletion:</strong> Request the deletion of your personal data (subject to legal and contractual obligations).</li>
                            <li><strong>Data Portability:</strong> Request a copy of your data in a portable format.</li>
                            <li><strong>Withdraw Consent:</strong> Opt-out of marketing communications or withdraw consent where applicable.</li>
                        </ul>
                        <p>To exercise any of these rights, contact us at <a href="mailto:techXpertz.tech@gmail.com">techXpertz.tech@gmail.com</a>.</p>
                    </div>

                    <div class="section">
                        <h2>7. Data Security</h2>
                        <p>We employ robust security measures to protect your data from unauthorized access, disclosure, alteration, or destruction. These include encryption, firewalls, and regular system audits.</p>
                        <p>However, no method of transmission over the Internet or electronic storage is completely secure. While we strive to protect your information, we cannot guarantee its absolute security.</p>
                    </div>

                    <div class="section">
                        <h2>8. International Data Transfers</h2>
                        <p>If you access our platform from outside the Philippines, your data may be transferred to and processed in the Philippines, where our servers are located. By using our platform, you consent to this transfer.</p>
                    </div>

                    <div class="section">
                        <h2>9. Children’s Privacy</h2>
                        <p>Our services are not intended for users under the age of 18 without parental or guardian consent. If we discover that we have inadvertently collected data from a minor, we will delete it immediately.</p>
                    </div>

                    <div class="section">
                        <h2>10. Changes to This Privacy Policy</h2>
                        <p>We may update this Privacy Policy from time to time to reflect changes in our practices or legal obligations. Updates will be posted on this page, and your continued use of the platform constitutes acceptance of these changes.</p>
                    </div>

                    <div class="section">
                        <h2>11. Contact Us</h2>
                        <p>If you have any questions, concerns, or requests related to this Privacy Policy, you can reach us at:</p>
                        <ul>
                            <li><strong>Email:</strong> <a href="mailto:techXpertz.tech@gmail.com">techXpertz.tech@gmail.com</a></li>
                            <li><strong>Website:</strong> <a href="https://techxpertz.tech">https://techxpertz.tech</a></li>
                        </ul>
                    </div>
                    <div class="disclaimer">
                        <p><strong>Disclaimer:</strong> The Terms and Conditions and Privacy Policy on this website are provided as of <em>November 20, 2024</em>, and are subject to review and updates. We are committed to ensuring compliance with applicable laws and regulations and will consult legal professionals to finalize our policies. For any concerns or questions, please contact us at <a href="/contact-us">techxpertz.tech@gmail.com</a>.</p>
                    </div>
                </div>

                <div id="terms-of-service" class="form-section">
                    <div class="section">
                        <h2>1. Introduction</h2>
                        <p>Welcome to TechXpertz, accessible at <a href="https://techxpertz.tech/" target="_blank">https://techxpertz.tech/</a> (the "Website"). TechXpertz ("we," "us," or "our") is committed to connecting customers with reliable and skilled technicians for electronic repairs. These Terms and Conditions (the "Terms") govern your use of the Website, and by accessing or using our Website, you agree to comply with and be bound by these Terms.</p>
                        <p>If you do not agree with these Terms, please do not use our Website.</p>
                    </div>

                    <div class="section">
                        <h2>2. Website Information</h2>
                        <ul>
                            <li><strong>Website Name:</strong> TechXpertz</li>
                            <li><strong>Website Email:</strong> <a href="mailto:techXpertz.tech@gmail.com">techXpertz.tech@gmail.com</a></li>
                            <li><strong>Website URL:</strong> <a href="https://techxpertz.tech/" target="_blank">https://techxpertz.tech/</a></li>
                            <li><strong>Purpose:</strong> TechXpertz is a platform that connects customers with technicians for electronic repairs, aiming to enhance transparency, efficiency, and trust in the repair process.</li>
                        </ul>
                    </div>

                    <div class="section">
                        <h2>3. Eligibility</h2>
                        <p>To use our Website, you must be at least 18 years old or have obtained parental or guardian consent to use our services. By accessing TechXpertz, you represent and warrant that you are of legal age or have the consent required to enter into these Terms.</p>
                    </div>

                    <div class="section">
                        <h2>4. Account Registration</h2>
                        <p>To access certain features of the Website, you may need to create an account with us. You agree to provide accurate, current, and complete information during the registration process and to update such information to keep it accurate and current.</p>
                        <p>You are responsible for safeguarding your account login information and for any activities or actions under your account. TechXpertz will not be liable for any loss or damage arising from your failure to comply with these responsibilities.</p>
                    </div>

                    <div class="section">
                        <h2>5. Service Description</h2>
                        <p>TechXpertz provides an online platform for customers to:</p>
                        <ul>
                            <li>Discover local repair shops and skilled technicians.</li>
                            <li>Book appointments for device repairs.</li>
                            <li>Communicate directly with technicians.</li>
                            <li>Track repair progress in real-time.</li>
                            <li>Access and review technician ratings and service feedback.</li>
                        </ul>
                        <p>The Website aims to support users in finding trusted, high-quality repair services and to provide technicians with a streamlined way to connect with customers.</p>
                    </div>

                    <div class="section">
                        <h2>6. Privacy and Data Handling</h2>
                        <p>We prioritize the security and privacy of our users' data. By using TechXpertz, you acknowledge and consent to our data collection and handling practices, as outlined below:</p>
                        <ul>
                            <li><strong>Types of Data Collected:</strong> Personal information such as name, email, and phone number, and usage data such as browser type and pages visited.</li>
                            <li><strong>Data Usage and Storage:</strong> Your data is used to enhance your experience and provide services securely. Robust measures are in place to protect your information.</li>
                            <li><strong>Third-Party Sharing:</strong> Data may be shared with service providers for analytics, troubleshooting, or delivering services, but only under strict confidentiality agreements.</li>
                            <li><strong>User Rights:</strong> You may request access, updates, or deletion of your personal data as required by GDPR or applicable laws.</li>
                        </ul>
                    </div>

                    <div class="section">
                        <h2>7. Disclaimer on Technician Services</h2>
                        <p>TechXpertz connects customers with independent technicians. We do not directly provide repair services and are not responsible for the quality or outcomes of services rendered by technicians. Any disputes or issues regarding services are between the customer and the technician directly. TechXpertz limits its liability in such cases.</p>
                    </div>

                    <div class="section">
                        <h2>8. User Responsibilities</h2>
                        <p>When using our platform, you agree to:</p>
                        <ul>
                            <li>Provide accurate information in your profile and repair requests.</li>
                            <li>Comply with all applicable legal requirements related to device repairs.</li>
                            <li>Engage with technicians respectfully and responsibly.</li>
                        </ul>
                    </div>

                    <div class="section">
                        <h2>9. Intellectual Property of User-Submitted Content</h2>
                        <p>Users may submit reviews, ratings, or comments on the Website. By submitting content, you grant TechXpertz a worldwide, non-exclusive, royalty-free license to display, distribute, and modify this content for platform functionality. TechXpertz reserves the right to remove content that violates these Terms.</p>
                    </div>

                    <div class="section">
                        <h2>10. Dispute Resolution and Governing Law</h2>
                        <p>These Terms are governed by and construed in accordance with the laws of the Philippines. Any disputes arising out of or related to these Terms shall be resolved through mediation or arbitration before resorting to courts. The exclusive jurisdiction is the courts of the Philippines.</p>
                    </div>

                    <div class="section">
                        <h2>11. Limitation of Liability and Warranties</h2>
                        <p>TechXpertz provides the Website on an "as-is" basis without warranties of any kind. We disclaim liability for any indirect or consequential damages arising from the use of our platform.</p>
                    </div>

                    <div class="section">
                        <h2>12. Periodic Review</h2>
                        <p>We may revise these Terms periodically. Updates will be posted on the Website, and continued use implies agreement to the updated Terms.</p>
                    </div>

                    <div class="section">
                        <h2>13. Contact Information</h2>
                        <p>If you have any questions or concerns regarding these Terms, please contact us at:</p>
                        <ul>
                            <li><strong>Email:</strong> <a href="mailto:techXpertz.tech@gmail.com">techXpertz.tech@gmail.com</a></li>
                            <li><strong>Website:</strong> <a href="https://techxpertz.tech/" target="_blank">https://techxpertz.tech/</a></li>
                        </ul>
                    </div>

                    <div class="disclaimer">
                        <p><strong>Disclaimer:</strong> The Terms and Conditions and Privacy Policy on this website are provided as of <em>November 20, 2024</em>, and are subject to review and updates. We are committed to ensuring compliance with applicable laws and regulations and will consult legal professionals to finalize our policies. For any concerns or questions, please contact us at <a href="/contact-us">techxpertz.tech@gmail.com</a>.</p>
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
    <script src="{{asset('js/Customer/customer-loadingscreen.js')}}" defer></script>
    <script src="{{asset('js/Customer/header-footer.js')}}" defer></script>
</html>
