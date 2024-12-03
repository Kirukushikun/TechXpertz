<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TechXpertz</title>
    <link rel="icon" href="{{ asset('images/TechXpertz-Icon.ico') }}">
    <link rel="stylesheet" href="{{ asset('css/Customer/0 - Registration.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>


<div class="form-container">
    <h1>Sign <span>Up</span></h1>
    <form id="registration-form" action="{{ route('customer.signupCustomer') }}" method="POST">
        @if(session()->has('error'))
            <p class="error-message">{{session('error')}}</p>
        @endif
        @csrf

        <p class="invalid-message"></p>

        <div class="input-group">
            <input type="text" name="firstname" id="firstname" placeholder="First Name" required>
            <input type="text" name="lastname" id="lastname" placeholder="Last Name" required>
        </div>
        <div class="input-group">
            <select id="province" name="province" class="province" required>
                <option value="">Province</option>
            </select>
            <select id="city_municipality" name="city_municipality" class="city_municipality" required>
                <option value="">City/Municipality</option>
            </select>
            <select id="barangay" name="barangay" class="barangay" required>
                <option value="">Barangay</option>
            </select>
        </div>

        <input type="number" name="contact" id="contact" placeholder="Contact Number" required />
        <input type="email" name="email" id="email" placeholder="Email Address" required />
        <div class="input-password" id="input-password">
            <input type="password" name="password" id="password" placeholder="Password" required />
            <i id="icon" class="fa-solid fa-eye-slash" onmousedown="reveal('password')" onmouseup="unreveal('password')"></i>
        </div>
        <input type="password" name="cpassword" id="cpassword" placeholder="Confirm Password" required />
        <button type="submit" onclick="validateInputs(event)">Sign Up</button>

    </form>
    <div class="signup-link">
        <p>Already have an account? <a href="{{route('customer.login')}}">Sign In</a></p>
    </div>

</div>

<script>
    // User location dropdown elements
    const provinceSelect = document.getElementById('province');
    const citySelect = document.getElementById('city_municipality');
    const barangaySelect = document.getElementById('barangay');

    let allCitiesMunicipalities = [];
    let allBarangays = [];

    // Fetch and populate provinces for both user and shop
    async function fetchProvinces() {
        try {
            const response = await fetch('https://psgc.gitlab.io/api/provinces.json');
            const provinces = await response.json();
            populateProvinces(provinces, provinceSelect);
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
        citySelect.innerHTML = '<option value="">City/Municipality</option>'; // Reset Provinces
        barangaySelect.innerHTML = '<option value="">Barangay</option>'; // Reset barangays

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
        barangaySelect.innerHTML = '<option value="">Barangay</option>';

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

    // Initial fetch calls
    fetchProvinces();
    fetchCitiesMunicipalities();
    fetchBarangays();
</script>

<script>
    function reveal(input) {
        let password = document.getElementById(input);
        let icon = document.getElementById("icon");
        password.type = "text";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
    }

    function unreveal(input) {
        let password = document.getElementById("password");
        let icon = document.getElementById("icon");
        password.type = "password";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
    }
</script>

<script>
    function validateInputs(event) {
        // Prevent the default form submission
        event.preventDefault();

        // Get form input values
        const contact = document.getElementById("contact").value;
        const password = document.getElementById("password").value;
        const cpassword = document.getElementById("cpassword").value;

        // Get the message display area
        const messageElement = document.querySelector(".invalid-message");

        // Initialize validation status and error message
        let isValid = true;
        let errorMessage = "";

        // Validate contact number (must be 11 digits)
        if (contact.length !== 11) {
            isValid = false;
            errorMessage = "Contact number must be exactly 11 digits.";
        }
        // Validate password length (must be at least 8 characters)
        else if (password.length < 8) {
            isValid = false;
            errorMessage = "Password must be at least 8 characters long.";
        }
        // Validate password and confirm password match
        else if (password !== cpassword) {
            isValid = false;
            errorMessage = "Password and Confirm Password do not match.";
        }

        // Display error message if validation fails
        if (!isValid) {
            messageElement.textContent = errorMessage;
            messageElement.style.display = "block";
            return false; // Stop form submission
        }

        messageElement.style.display = "none";

        // Clear the message and submit the form if valid
        messageElement.textContent = "";
        document.querySelector("form").submit();
    }


</script>

</body>

</html>
