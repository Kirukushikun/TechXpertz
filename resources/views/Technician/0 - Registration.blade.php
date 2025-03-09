<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>TechXpertz</title>
        <link rel="icon" href="{{ asset('images/TechXpertz-Icon.ico') }}" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="{{asset('css/Technician/0 - Registration.css')}}" />
        <link rel="stylesheet" href="{{asset('css/Technician/technician-notification.css')}}" />
    </head>
    <body>
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

        <div class="input-validation-notification">

        </div>


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
                                        <input type="text" id="firstname" name="firstname" />
                                    </div>

                                    <div class="input-group">
                                        <label for="middlename">Middle Name</label>
                                        <input type="text" id="middlename" name="middlename" />
                                    </div>
                                    <div class="input-group">
                                        <label for="lastname">Last Name</label>
                                        <input type="text" id="lastname" name="lastname" />
                                    </div>
                                    <div class="input-group">
                                        <label for="email">Email Address</label>
                                        <input type="email" id="email" name="email" />
                                    </div>
                                    <div class="input-group">
                                        <label for="contact_no">Contact No.</label>
                                        <input type="tel" id="contact_no" name="contact_no" />
                                    </div>
                                    <div class="input-group">
                                        <label for="educational_background">Educational Background</label>
                                        <input type="text" id="educational_background" name="educational_background" />
                                    </div>
                                    <div class="input-group">
                                        <label for="province">Province</label>
                                        <select id="province" name="province" class="province">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                    <div class="input-group">
                                        <label for="city_municipality">City or Municipality</label>
                                        <select id="city_municipality" name="city_municipality" class="city_municipality">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                    <div class="input-group">
                                        <label for="barangay">Barangay</label>
                                        <select id="barangay" name="barangay" class="barangay">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                    <div class="input-group">
                                        <label for="zip_code">ZIP Code</label>
                                        <input type="text" id="zip_code" name="zip_code" />
                                    </div>
                                    <div class="input-group">
                                        <label for="date_of_birth">Date of Birth</label>
                                        <input type="date" id="date_of_birth" name="date_of_birth" />
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
                                        <input type="text" id="shop_name" name="shop_name" />
                                    </div>
                                    <div class="input-group">
                                        <label for="shop_email">Shop Email Address</label>
                                        <input type="email" id="shop_email" name="shop_email" />
                                    </div>
                                    <div class="input-group">
                                        <label for="shop_contact">Business Contact No.</label>
                                        <input type="tel" id="shop_contact" name="shop_contact" />
                                    </div>
                                    <div class="input-group">
                                        <label for="shop_address">Shop Address</label>
                                        <input type="tel" id="shop_address" name="shop_address" />
                                    </div>
                                    <div class="input-group">
                                        <label for="shop_province">Province</label>
                                        <select id="shop_province" name="shop_province" class="shop_province">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                    <div class="input-group">
                                        <label for="shop_city">City</label>
                                        <select id="shop_city" name="shop_city" class="shop_city">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                    <div class="input-group">
                                        <label for="shop_barangay">Barangay</label>
                                        <select id="shop_barangay" name="shop_barangay" class="shop_barangay">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                    <div class="input-group">
                                        <label for="shop_zip_code">ZIP Code</label>
                                        <input type="text" id="shop_zip_code" name="shop_zip_code" />
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
                                    <h3>1. Introduction</h3>
                                    <p>Welcome to TechXpertz, accessible at <a href="https://techxpertz.tech/" target="_blank">https://techxpertz.tech/</a> (the "Website"). TechXpertz ("we," "us," or "our") is committed to connecting customers with reliable and skilled technicians for electronic repairs. These Terms and Conditions (the "Terms") govern your use of the Website, and by accessing or using our Website, you agree to comply with and be bound by these Terms.</p>
                                    <p>If you do not agree with these Terms, please do not use our Website.</p>
                                </div>

                                <div class="section">
                                    <h3>2. Website Information</h3>
                                    <ul>
                                        <li><strong>Website Name:</strong> TechXpertz</li>
                                        <li><strong>Website Email:</strong> <a href="mailto:techXpertz.tech@gmail.com">techXpertz.tech@gmail.com</a></li>
                                        <li><strong>Website URL:</strong> <a href="https://techxpertz.tech/" target="_blank">https://techxpertz.tech/</a></li>
                                        <li><strong>Purpose:</strong> TechXpertz is a platform that connects customers with technicians for electronic repairs, aiming to enhance transparency, efficiency, and trust in the repair process.</li>
                                    </ul>
                                </div>

                                <div class="section">
                                    <h3>3. Eligibility</h3>
                                    <p>To use our Website, you must be at least 18 years old or have obtained parental or guardian consent to use our services. By accessing TechXpertz, you represent and warrant that you are of legal age or have the consent required to enter into these Terms.</p>
                                </div>

                                <div class="section">
                                    <h3>4. Account Registration</h3>
                                    <p>To access certain features of the Website, you may need to create an account with us. You agree to provide accurate, current, and complete information during the registration process and to update such information to keep it accurate and current.</p>
                                    <p>You are responsible for safeguarding your account login information and for any activities or actions under your account. TechXpertz will not be liable for any loss or damage arising from your failure to comply with these responsibilities.</p>
                                </div>

                                <div class="section">
                                    <h3>5. Service Description</h3>
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
                                    <h3>6. Privacy and Data Handling</h3>
                                    <p>We prioritize the security and privacy of our users' data. By using TechXpertz, you acknowledge and consent to our data collection and handling practices, as outlined below:</p>
                                    <ul>
                                        <li><strong>Types of Data Collected:</strong> Personal information such as name, email, and phone number, and usage data such as browser type and pages visited.</li>
                                        <li><strong>Data Usage and Storage:</strong> Your data is used to enhance your experience and provide services securely. Robust measures are in place to protect your information.</li>
                                        <li><strong>Third-Party Sharing:</strong> Data may be shared with service providers for analytics, troubleshooting, or delivering services, but only under strict confidentiality agreements.</li>
                                        <li><strong>User Rights:</strong> You may request access, updates, or deletion of your personal data as required by GDPR or applicable laws.</li>
                                    </ul>
                                </div>

                                <div class="section">
                                    <h3>7. Disclaimer on Technician Services</h3>
                                    <p>TechXpertz connects customers with independent technicians. We do not directly provide repair services and are not responsible for the quality or outcomes of services rendered by technicians. Any disputes or issues regarding services are between the customer and the technician directly. TechXpertz limits its liability in such cases.</p>
                                </div>

                                <div class="section">
                                    <h3>8. User Responsibilities</h3>
                                    <p>When using our platform, you agree to:</p>
                                    <ul>
                                        <li>Provide accurate information in your profile and repair requests.</li>
                                        <li>Comply with all applicable legal requirements related to device repairs.</li>
                                        <li>Engage with technicians respectfully and responsibly.</li>
                                    </ul>
                                </div>

                                <div class="section">
                                    <h3>9. Intellectual Property of User-Submitted Content</h3>
                                    <p>Users may submit reviews, ratings, or comments on the Website. By submitting content, you grant TechXpertz a worldwide, non-exclusive, royalty-free license to display, distribute, and modify this content for platform functionality. TechXpertz reserves the right to remove content that violates these Terms.</p>
                                </div>

                                <div class="section">
                                    <h3>10. Dispute Resolution and Governing Law</h3>
                                    <p>These Terms are governed by and construed in accordance with the laws of the Philippines. Any disputes arising out of or related to these Terms shall be resolved through mediation or arbitration before resorting to courts. The exclusive jurisdiction is the courts of the Philippines.</p>
                                </div>

                                <div class="section">
                                    <h3>11. Limitation of Liability and Warranties</h3>
                                    <p>TechXpertz provides the Website on an "as-is" basis without warranties of any kind. We disclaim liability for any indirect or consequential damages arising from the use of our platform.</p>
                                </div>

                                <div class="section">
                                    <h3>12. Periodic Review</h3>
                                    <p>We may revise these Terms periodically. Updates will be posted on the Website, and continued use implies agreement to the updated Terms.</p>
                                </div>

                                <div class="section">
                                    <h3>13. Contact Information</h3>
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
                            <div class="form-navigation-buttons">
                                <button type="button" class="prev-btn">Previous</button>
                                <button type="button" class="next-btn">Next</button>
                            </div>
                        </div>

                        <div class="form-step" data-step="4">
                            <h2>Privacy Policy</h2>
                            <div class="terms-condition">
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
                                    <input type="email-preview" id="email-preview" name="email-preview" />
                                </div>
                                <div class="group-container">
                                    <div class="input-group">
                                        <label for="password">Password</label>
                                        <input type="password" id="password" name="password" />
                                    </div>
                                    <div class="input-group">
                                        <label for="password_confirmation">Confirm Password</label>
                                        <input type="password" id="password_confirmation" name="password_confirmation" />
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
            const provinceSelect = document.getElementById("province");
            const citySelect = document.getElementById("city_municipality");
            const barangaySelect = document.getElementById("barangay");

            // Shop location dropdown elements
            const shopProvinceSelect = document.getElementById("shop_province");
            const shopCitySelect = document.getElementById("shop_city");
            const shopBarangaySelect = document.getElementById("shop_barangay");

            let allCitiesMunicipalities = [];
            let allBarangays = [];

            // Fetch and populate provinces for both user and shop
            async function fetchProvinces() {
                try {
                    const response = await fetch("https://psgc.gitlab.io/api/provinces.json");
                    const provinces = await response.json();
                    populateProvinces(provinces, provinceSelect);
                    populateProvinces(provinces, shopProvinceSelect);
                } catch (error) {
                    console.error("Error loading provinces:", error);
                }
            }

            // Populate provinces in a given select element
            function populateProvinces(provinces, selectElement) {
                provinces.forEach((province) => {
                    const option = document.createElement("option");
                    option.value = province.name; // Set the province name as the value
                    option.setAttribute("data-code", province.code); // Store the province code in data-code
                    option.textContent = province.name; // Display the province name as text
                    selectElement.appendChild(option);
                });
            }

            // Fetch and store cities/municipalities data
            async function fetchCitiesMunicipalities() {
                try {
                    const response = await fetch("https://psgc.gitlab.io/api/cities-municipalities.json");
                    allCitiesMunicipalities = await response.json();
                } catch (error) {
                    console.error("Error loading cities:", error);
                }
            }

            // Filter and display cities based on selected province in the specified city dropdown
            function filterCitiesByProvince(provinceCode, citySelect, barangaySelect) {
                const filteredCities = allCitiesMunicipalities.filter((city) => city.provinceCode === provinceCode);
                citySelect.innerHTML = '<option value="">Select City/Municipality</option>'; // Reset Provinces
                barangaySelect.innerHTML = '<option value="">Select Barangay</option>'; // Reset barangays

                filteredCities.forEach((city) => {
                    const option = document.createElement("option");
                    option.value = city.name; // Set the city name as the value
                    option.setAttribute("data-code", city.code); // Store the city code in data-code
                    option.textContent = city.name; // Display the city name as text
                    citySelect.appendChild(option);
                });
            }

            // Fetch and store barangays data
            async function fetchBarangays() {
                try {
                    const response = await fetch("https://psgc.gitlab.io/api/barangays.json");
                    allBarangays = await response.json();
                } catch (error) {
                    console.error("Error loading barangays:", error);
                }
            }

            // Filter and display barangays based on selected city/municipality in the specified barangay dropdown
            function filterBarangays(cityMunicipalityCode, barangaySelect) {
                const filteredBarangays = allBarangays.filter((barangay) => barangay.cityCode === cityMunicipalityCode || barangay.municipalityCode === cityMunicipalityCode);
                barangaySelect.innerHTML = '<option value="">Select Barangay</option>';

                filteredBarangays.forEach((barangay) => {
                    const option = document.createElement("option");
                    option.value = barangay.name; // Set the barangay name as the value
                    option.setAttribute("data-code", barangay.code); // Store the barangay code in data-code
                    option.textContent = barangay.name; // Display the barangay name as text
                    barangaySelect.appendChild(option);
                });
            }

            // Event Listeners for user location
            provinceSelect.addEventListener("change", function () {
                // Use the data-code to filter cities
                const selectedOption = provinceSelect.options[provinceSelect.selectedIndex];
                const provinceCode = selectedOption.getAttribute("data-code");
                filterCitiesByProvince(provinceCode, citySelect, barangaySelect);
            });
            citySelect.addEventListener("change", function () {
                const selectedOption = citySelect.options[citySelect.selectedIndex];
                const cityCode = selectedOption.getAttribute("data-code");
                filterBarangays(cityCode, barangaySelect);
            });

            // Event Listeners for shop location
            shopProvinceSelect.addEventListener("change", function () {
                const selectedOption = shopProvinceSelect.options[shopProvinceSelect.selectedIndex];
                const provinceCode = selectedOption.getAttribute("data-code");
                filterCitiesByProvince(provinceCode, shopCitySelect, shopBarangaySelect);
            });
            shopCitySelect.addEventListener("change", function () {
                const selectedOption = shopCitySelect.options[shopCitySelect.selectedIndex];
                const cityCode = selectedOption.getAttribute("data-code");
                filterBarangays(cityCode, shopBarangaySelect);
            });

            // Initial fetch calls
            fetchProvinces();
            fetchCitiesMunicipalities();
            fetchBarangays();
        </script>

        <script>
            document.getElementById("registrationForm").addEventListener("submit", function (event) {
                // Prevent default form submission
                event.preventDefault();

                // Get the container where notifications will be added
                const notificationContainer = document.querySelector(".input-validation-notification");

                // Clear any existing notifications
                notificationContainer.innerHTML = "";

                // Get input values
                const form = event.target;
                const contactNo = form.querySelector("#contact_no").value.trim();
                const shopcontactNo = form.querySelector("#shop_contact").value.trim();
                const password = form.querySelector("#password").value.trim();
                const confirmPassword = form.querySelector("#password_confirmation").value.trim();
                const allInputs = form.querySelectorAll("input, select");

                let isValid = true;
                let errorHeader = "";
                let errorMessage = "";

                // Check for empty fields
                allInputs.forEach((input) => {
                    if (!input.value.trim()) {
                        isValid = false;
                        errorHeader = "Missing Required Fields";
                        errorMessage = "Please fill in all required fields.";
                        input.classList.add("danger"); // Optional: add a class for styling invalid inputs
                    } else {
                        input.classList.remove("danger");
                    }
                });

                // Validate contact number (must be 11 digits)
                if (isValid && contactNo.length !== 11) {
                    isValid = false;
                    errorHeader = "Invalid Contact Number";
                    errorMessage = "Contact number must be exactly 11 digits.";
                }

                // Validate contact number (must be 11 digits)
                if (isValid && shopcontactNo.length !== 11) {
                    isValid = false;
                    errorHeader = "Invalid Contact Number";
                    errorMessage = "Contact number must be exactly 11 digits.";
                }


                // Validate password length (must be at least 8 characters)
                if (isValid && password.length < 8) {
                    isValid = false;
                    errorHeader = "Weak Password";
                    errorMessage = "Password must be at least 8 characters long.";
                }

                // Validate password and confirm password match
                if (isValid && password !== confirmPassword) {
                    isValid = false;
                    errorHeader = "Password Mismatch";
                    errorMessage = "Password and Confirm Password do not match.";
                }

                // Show notification if validation fails
                if (!isValid) {
                    // Create a new notification element
                    const notification = document.createElement("div");
                    notification.className = "push-notification danger";

                    notification.innerHTML = `
                        <i class="fa-solid fa-bell danger"></i>
                        <div class="notification-message">
                            <h4>${errorHeader}</h4>
                            <p>${errorMessage}</p>
                        </div>
                        <i class="fa-solid fa-xmark" id="close-notification"></i>
                    `;

                    // Add the notification to the container
                    notificationContainer.appendChild(notification);

                    // Animation: Show the push notification
                    setTimeout(() => {
                        notification.classList.add("active");
                    }, 500);

                    // Automatically hide the notification after 5 seconds
                    setTimeout(() => {
                        notification.classList.remove("active");
                    }, 5500);

                    // Close button functionality
                    const closeButton = notification.querySelector("#close-notification");
                    if (closeButton) {
                        closeButton.addEventListener("click", function () {
                            notification.classList.remove("active");
                        });
                    }

                    return;
                }

                // If validation passes, submit the form
                form.submit();
            });
        </script>

        <script src="{{asset('js/Technician/0 - Registration.js')}}" defer></script>
        <script src="{{asset('js/Technician/technician-notification.js')}}" defer></script>
    </body>
</html>
