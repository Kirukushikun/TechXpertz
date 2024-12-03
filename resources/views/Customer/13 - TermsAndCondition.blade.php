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
            <h1>Terms of Service</h1>

            <div class="content">
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
        </div>
        @yield('footer')
        <script src="{{asset('js/Customer/header-footer.js')}}" defer></script>
        <script src="{{asset('js/Customer/customer-loadingscreen.js')}}" defer></script>
    </body>
</html>
