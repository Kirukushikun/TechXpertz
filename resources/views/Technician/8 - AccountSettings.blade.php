@include('components.technician-sidebar')
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>TechXpertz</title>
        <!-- Crucial Part on every forms -->
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <!-- Crucial Part on every forms/ -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="{{asset('css/Technician/technician-sidebar.css')}}" />
        <link rel="stylesheet" href="{{asset('css/Technician/technician-modal.css')}}" />
        <link rel="stylesheet" href="{{asset('css/Technician/technician-notification.css')}}" />

        <link rel="stylesheet" href="{{asset('css/Technician/8 - AccountSettings.css')}}" />
    </head>
    <body>
        <div class="dashboard">
            <!-- PUSH NOTIFICATION -->
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

            <div class="modal" id="modal"></div>

            @yield('sidebar')

            <div class="main-content">
                <header>
                    <h1>Manage Profile</h1>
                    <div class="technician-name">
                        @php $technician = Auth::guard('technician')->user(); @endphp
                        <h3>Hi, <span>{{$technician->firstname}}.</span></h3>
                    </div>
                </header>

                <div class="content">
                    <div class="left">
                        <div class="upper">
                            <div class="profile-navigation">
                                <h2>Technician Profile</h2>
                                <ul>
                                    <li><a href="#" data-target="technician-details" class="active">Personal Information</a></li>
                                    <li><a href="#" data-target="change-password">Change Password</a></li>
                                    <li><a href="#" data-target="activity-logs">Access Logs</a></li>
                                    <li><a href="#" data-target="terms-of-service">Terms of Service</a></li>
                                    <li><a href="#" data-target="privacy-policy">Privacy Policy</a></li>
                                    <li><a href="#" data-target="report">Report</a></li>
                                    <li><a href="#" data-target="delete-account">Delete Account</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="right">
                        <form id="technician-details" class="form-container active" action="/technician/account/update" method="POST">
                            @csrf @method('PATCH')
                            <div class="form-header">
                                <div class="profile-detail">
                                    <div class="image"></div>
                                    <div class="details">
                                        <h3>{{$technician->firstname}} {{$technician->middlename ?? ''}} {{$technician->lastname}}</h3>
                                        <p>{{$technician->email}}</p>
                                        <span id="complete">{{$technician->profile_status == 'complete' ? 'verified' : $technician->profile_status}}</span>
                                    </div>
                                </div>

                                <div class="profile-action">
                                    <!-- <button class="btn-primary">View picture</button>
                                <button class="btn-normal">Delete picture</button> -->
                                </div>
                            </div>

                            <div class="form-section col-3">
                                <div class="form-group">
                                    <label for="firstname">First Name</label>
                                    <input type="text" id="firstname" name="firstname" value="{{$technician->firstname}}" required />
                                </div>
                                <div class="form-group">
                                    <label for="middlename">Middle Name</label>
                                    <input type="text" id="middlename" name="middlename" value="{{$technician->middlename ?? ''}}" required />
                                </div>
                                <div class="form-group">
                                    <label for="lastname">Last Name</label>
                                    <input type="text" id="lastname" name="lastname" value="{{$technician->lastname}}" required />
                                </div>

                                <div class="form-group">
                                    <label for="email">Email Address</label>
                                    <input type="text" id="email" name="email" value="{{$technician->email}}" required />
                                </div>
                                <div class="form-group">
                                    <label for="contact_no">Contact No.</label>
                                    <input type="text" id="contact_no" name="contact_no" value="{{$technician->contact_no}}" required />
                                </div>
                                <div class="form-group">
                                    <label for="educational_background">Educational Background</label>
                                    <input type="text" id="educational_background" name="educational_background" value="{{$technician->educational_background}}" required />
                                </div>

                                <div class="form-group">
                                    <label for="province">Province</label>
                                    <input type="text" id="province" name="province" value="{{$technician->province}}" required />
                                </div>
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <input type="text" id="city" name="city" value="{{$technician->city}}" required />
                                </div>
                                <div class="form-group">
                                    <label for="barangay">Barangay</label>
                                    <input type="text" id="barangay" name="barangay" value="{{$technician->barangay}}" required />
                                </div>

                                <div class="form-group">
                                    <label for="zip_code">ZIP Code</label>
                                    <input type="text" id="zip_code" name="zip_code" value="{{$technician->zip_code}}" required />
                                </div>

                                <div class="form-group">
                                    <label for="date_of_birth">Date of Birth</label>
                                    <input type="date" id="date_of_birth" name="date_of_birth" value="{{$technician->date_of_birth->format('Y-m-d')}}" required />
                                </div>
                            </div>

                            <div class="form-action">
                                <button type="submit" class="btn-primary">Save Changes</button>
                            </div>
                        </form>

                        <div id="change-password" class="form-container">
                            <form action="/technician/account/password/change" id="change-password-form" method="POST">
                                @csrf @method('PATCH')
                                <div class="form-group">
                                    <label for="current_password">Current Password</label>
                                    <input type="password" id="current_password" name="current_password" required />
                                </div>
                                <br />
                                <div class="form-section col-2">
                                    <div class="form-group">
                                        <label for="new_password">New Password</label>
                                        <input type="password" id="new_password" name="new_password" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="new_password_confirmation">Confirm New Password</label>
                                        <input type="password" id="new_password_confirmation" name="new_password_confirmation" required />
                                    </div>
                                </div>
                                <br />

                                <div class="form-action">
                                    <a href="/technician/password/forgot">Forgot Password?</a>
                                    <button type="submit" class="btn-primary">Change Password</button>
                                </div>
                            </form>
                        </div>

                        <div id="activity-logs" class="form-container">
                            <div class="form-header">
                                <h2>Activity Logs</h2>
                            </div>

                            <table>
                                <thead>
                                    <tr>
                                        <th>Timestamp</th>
                                        <th>Action</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>IP Address</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($activityLogs as $activityLog)
                                    <tr>
                                        <td>
                                            {{$activityLog->created_at->format('d M, Y')}} <br />
                                            {{$activityLog->created_at->format('h:i A')}}
                                        </td>
                                        <td>{{$activityLog->action}}</td>
                                        <td>{{$activityLog->description}}</td>
                                        <td>{{$activityLog->status}}</td>
                                        <td>{{$activityLog->ip_address}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div id="terms-of-service" class="form-container">
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

                        <div id="privacy-policy" class="form-container">
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

                        <div id="report" class="form-container">
                            <form action="/technician/submit/report" id="submit-report-form" method="POST">
                                @csrf
                                <input type="hidden" id="firstname" name="firstname" value="{{$technician->firstname}}" />
                                <input type="hidden" id="lastname" name="lastname" value="{{$technician->lastname}}" />
                                <input type="hidden" id="email" name="email" value="{{$technician->email}}" />

                                <div class="form-group">
                                    <label for="category">Category</label>
                                    <select type="category" id="category" name="category" required>
                                        <option value="Account Issues">Account Issues</option>
                                        <option value="Service Management Problems">Service Management Problems</option>
                                        <option value="Customer Interaction Issues">Customer Interaction Issues</option>
                                        <option value="Performance and Usability">Performance and Usability</option>
                                        <option value="Notifications and Alerts">Notifications and Alerts</option>
                                        <option value="Booking and Appointment Issues">Booking and Appointment Issues</option>
                                        <option value="Customer Feedback and Ratings">Customer Feedback and Ratings</option>
                                        <option value="Content and Profile Management">Content and Profile Management</option>
                                        <option value="Technician Performance">Technician Performance</option>
                                        <option value="Website Performance and Display Issues">User Interface (UI) & User Experience (UX)</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="sub_category">Sub Category</label>
                                    <select type="sub_category" id="sub_category" name="sub_category" required>
                                        <option value=""></option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="description">Issue Description</label>
                                    <textarea name="description" class="description" id="description" cols="25" rows="7" required></textarea>
                                </div>

                                <div class="form-action">
                                    <button type="submit" class="btn-primary">SUBMIT</button>
                                </div>
                            </form>
                        </div>
                        <div id="delete-account" class="form-container">
                            <div class="form">
                                <h2>Delete Account</h2>
                                <p>Permanently delete your account. This action is irreversible. All of your data, including your profile, messages, and settings, will be permanently deleted. You will not be able to recover your account once it has been deleted.</p>
                                <ul>
                                    <li><strong>Permanent Data Loss:</strong> All of your account data, including services offered, appointment history, customer messages, profile information, and settings, will be permanently deleted. You will lose all records related to your work and interactions on this platform.</li>
                                    <li><strong>No Account Recovery:</strong> Once your account is deleted, you will lose all access and will need to create a new technician account to provide services again. Deletion is permanent, and previously held data cannot be retrieved.</li>
                                    <li><strong>Pending or Active Appointments and Repairs:</strong> If you have any pending or active appointments or repairs with customers, your account deletion request will not proceed. Please make sure to complete, cancel, or settle all ongoing services before attempting to delete your account.</li>
                                </ul>

                                <div class="form-action">
                                    <button class="btn-danger" id="delete-account">Delete Account</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const links = document.querySelectorAll(".profile-navigation a");
                const sections = document.querySelectorAll(".right .form-container");

                // Add event listeners to each navigation link
                links.forEach((link) => {
                    link.addEventListener("click", function (event) {
                        event.preventDefault();

                        // Remove the 'active' class from all links
                        links.forEach((link) => link.classList.remove("active"));

                        // Add the 'active' class to the clicked link
                        this.classList.add("active");

                        // Hide all sections
                        sections.forEach((section) => section.classList.remove("active"));

                        // Show the corresponding section
                        const sectionId = this.getAttribute("data-target");
                        document.getElementById(sectionId).classList.add("active");
                    });
                });
            });
        </script>
        <script>
            let mainCategory = document.getElementById("category");
            let subCategory = document.getElementById("sub_category");
            let subCategoryContents = {
                "Account Issues": ["I can't access my account.", "My login credentials aren't working.", "I forgot my password and can't reset it.", "I'm not receiving my account verification email.", "My account is locked or disabled.", "My profile information isn't updating correctly.", "Changes to my contact information aren't saving.", "Other"],
                "Service Management Problems": ["I can't add or update my services.", "Clients see incorrect or outdated schedule options.", "My rates aren't displayed accurately.", "I can't set or update custom prices for services.", "Other"],
                "Customer Interaction Issues": ["I'm having trouble with messaging.", "My messages to customers aren't going through.", "I don't receive notifications for new messages.", "Customer contact information is incomplete.", "I can't view the customer's full contact details.", "The customer's phone number or email is missing.", "Customers aren't responding or canceling appointments.", "I'm experiencing high rates of no-shows.", "Customers frequently reschedule on short notice.", "Other"],
                "Performance and Usability": ["The website is slow or unresponsive.", "Pages take too long to load on my device.", "Features are laggy or freeze during use.", "The layout or interface is difficult to navigate.", "Buttons or menus aren't easy to find.", "The mobile view is hard to use.", "I'm experiencing errors or glitches.", "Error messages pop up unexpectedly.", "I encounter frequent bugs or crashes.", "Other"],
                "Notifications and Alerts": ["I'm not receiving notifications as expected.", "I don't get alerts for new bookings or messages.", "System notifications are delayed or missing.", "The notifications I receive are incorrect or irrelevant.", "I get alerts unrelated to my services.", "Other"],
                "Booking and Appointment Issues": ["I can't view or manage my appointments.", "Appointments are missing or duplicated.", "Booking confirmations or updates aren't reaching customers.", "Customers report they don't get confirmation emails.", "Updates to bookings aren't notifying clients.", "Booking attempts fail for clients on my profile.", "Other"],
                "Customer Feedback and Ratings": ["Customer reviews seem inaccurate or inappropriate.", "I received an unfair or offensive review.", "Reviews from unknown clients appear on my profile.", "My overall rating isn't updating correctly.", "New reviews aren't affecting my overall rating.", "My average rating displays inconsistently across pages.", "I need assistance responding to reviews.", "I can't reply to feedback on my profile.", "My responses to reviews aren't saving.", "Other"],
                "Content and Profile Management": ["I'm having trouble uploading images or files.", "Profile pictures or gallery images aren't uploading.", "My profile information isn't displaying correctly.", "Bio or description sections show errors.", "I need assistance with profile visibility or settings.", "My profile doesn't show up in search results.", "Other"],
                "Website Performance and Display Issues": ["Tables, graphs, or layouts are misaligned.", "Content is cut off or overlapping on smaller screens.", "I'm experiencing broken links or missing pages.", "Some links lead to error pages or are nonfunctional.", "Pages load with missing content or images.", "I'm having trouble with the website's accessibility.", "Text or buttons are difficult to read or interact with.", "Other"],
            };

            // Define the function to populate sub-categories
            function populateSubCategories() {
                // Clear any existing options in the sub-category dropdown
                subCategory.innerHTML = "";

                // Get the selected main category value
                let selectedCategory = mainCategory.value;

                // Retrieve the corresponding sub-category list
                let subCategories = subCategoryContents[selectedCategory];

                // Populate sub-category dropdown if there are sub-categories
                if (subCategories) {
                    subCategories.forEach((subCat) => {
                        let option = document.createElement("option");
                        option.value = subCat;
                        option.textContent = subCat;
                        subCategory.appendChild(option);
                    });
                }
            }

            // Add an event listener to the main category dropdown to trigger sub-category update
            mainCategory.addEventListener("change", populateSubCategories);

            // Optionally, call the function initially to set sub-categories on page load
            populateSubCategories();
        </script>

        <script>
            let modal = document.getElementById("modal");
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

            let personalInformationForm = document.getElementById("technician-details");
            let personalInformationAction = personalInformationForm.querySelector(".form-action");
            let personalInformationInputs = personalInformationForm.querySelectorAll("input");

            personalInformationInputs.forEach((input) => {
                input.addEventListener("input", function () {
                    personalInformationAction.classList.add("active");
                });
            });

            let personalInformationSubmitBtn = personalInformationAction.querySelector(".btn-primary");
            personalInformationSubmitBtn.addEventListener("click", function (event) {
                event.preventDefault();
                modal.innerHTML = `
            <div>
                <div class="modal-verification">
                    <i class="fa-solid fa-xmark close icon-close"></i>
                    <i class="fa-regular fa-calendar-check sign-primary"></i>
                    <div class="verification-message">
                        <h2>Confirm Appointment</h2>
                        <p>Are you sure you want to confirm this appointment?</p>
                    </div>
                    <div class="verification-action">
                        <button type="submit" class="btn-primary" id="personal-information">Confirm Appointment</button>
                        <button type="button" class="close btn-normal"><b>Dismiss</b></button>
                    </div>
                </div>                
            </div>
            `;

                document.getElementById("personal-information").addEventListener("click", function () {
                    personalInformationForm.submit();
                });

                modal.classList.add("active");

                // Close modal when 'X' is clicked
                document.querySelectorAll(".close").forEach((button) => {
                    button.onclick = function () {
                        modal.classList.remove("active");
                    };
                });
            });

            let changePasswordForm = document.getElementById("change-password-form");
            let changePasswordAction = changePasswordForm.querySelector(".btn-primary");
            let changePasswordInputs = changePasswordForm.querySelectorAll("input");

            changePasswordInputs.forEach((input) => {
                input.addEventListener("input", function () {
                    changePasswordAction.classList.add("active");
                });
            });

            changePasswordAction.addEventListener("click", function (event) {
                event.preventDefault();
                modal.innerHTML = `
            <div>
                <div class="modal-verification">
                    <i class="fa-solid fa-xmark close icon-close"></i>
                    <i class="fa-regular fa-calendar-check sign-primary"></i>
                    <div class="verification-message">
                        <h2>Change Password</h2>
                        <p>Are you sure you want to change your password?</p>
                    </div>
                    <div class="verification-action">
                        <button type="submit" class="btn-primary" id="change-password">Confirm Appointment</button>
                        <button type="button" class="close btn-normal"><b>Dismiss</b></button>
                    </div>
                </div>                
            </div>
            `;

                document.getElementById("change-password").addEventListener("click", function () {
                    changePasswordForm.submit();
                });

                modal.classList.add("active");

                // Close modal when 'X' is clicked
                document.querySelectorAll(".close").forEach((button) => {
                    button.onclick = function () {
                        modal.classList.remove("active");
                    };
                });
            });

            let submitReportForm = document.getElementById("submit-report-form");
            let submitReportAction = submitReportForm.querySelector(".btn-primary");
            // let submitReportInputs = changePasswordForm.querySelectorAll('input');

            submitReportAction.addEventListener("click", function (event) {
                event.preventDefault();
                modal.innerHTML = `
            <div>
                <div class="modal-verification">
                    <i class="fa-solid fa-xmark close icon-close"></i>
                    <i class="fa-regular fa-calendar-check sign-primary"></i>
                    <div class="verification-message">
                        <h2>Submit Report</h2>
                        <p>Are you sure you want to submit your report?</p>
                    </div>
                    <div class="verification-action">
                        <button type="submit" class="btn-primary" id="submit-report">Submit Report</button>
                        <button type="button" class="close btn-normal"><b>Dismiss</b></button>
                    </div>
                </div>                
            </div>
            `;

                document.getElementById("submit-report").addEventListener("click", function () {
                    submitReportForm.submit();
                });

                modal.classList.add("active");

                // Close modal when 'X' is clicked
                document.querySelectorAll(".close").forEach((button) => {
                    button.onclick = function () {
                        modal.classList.remove("active");
                    };
                });
            });

            document.getElementById("delete-account").addEventListener("click", function () {
                modal.innerHTML = `
            <form action="/technician/account/delete" method="POST">
                <input type="hidden" name="_token" value="${csrfToken}">
                <input type="hidden" name="_method" value="PATCH">
                <div class="modal-verification">
                    <i class="fa-solid fa-xmark close icon-close"></i>
                    <i class="fa-regular fa-calendar-check sign-danger"></i>
                    <div class="verification-message">
                        <h2>Account Deletion</h2>
                        <p>Are you sure you want to delete your account?</p>
                    </div>
                    <div class="verification-action">
                        <button type="submit" class="btn-danger">Confirm Deletion</button>
                        <button type="button" class="close btn-normal"><b>Dismiss</b></button>
                    </div>
                </div>                
            </form>
            `;

                document.getElementById("change-password").addEventListener("click", function () {
                    changePasswordForm.submit();
                });

                modal.classList.add("active");

                // Close modal when 'X' is clicked
                document.querySelectorAll(".close").forEach((button) => {
                    button.onclick = function () {
                        modal.classList.remove("active");
                    };
                });
            });
        </script>
        <script src="{{asset('js/Technician/technician-sidebar.js')}}" defer></script>
        <script src="{{asset('js/Technician/technician-notification.js')}}" defer></script>
    </body>
</html>
