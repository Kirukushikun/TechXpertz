@include('components.header-footer')
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>TechXpertz</title>
        <link rel="icon" href="{{ asset('images/TechXpertz-Icon.ico') }}" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="{{ asset('css/Customer/customer-headerfooter.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/Customer/customer-loadingscreen.css') }}" />

        <link rel="stylesheet" href="{{ asset('css/Customer/13 - TermsAndPrivacy.css') }}" />
    </head>
    <body>
        @yield('header')
        <div class="main-container">
            <h1>Privacy Policy</h1>

            <div class="content">
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
        </div>
        @yield('footer')
        <script src="{{asset('js/Customer/header-footer.js')}}" defer></script>
        <script src="{{asset('js/Customer/customer-loadingscreen.js')}}" defer></script>
    </body>
</html>
