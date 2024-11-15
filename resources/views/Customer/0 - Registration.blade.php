<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TechXpertz</title>
    <link rel="icon" href="{{ asset('images/TechXpertz-Icon.ico') }}">
    <link rel="stylesheet" href="{{ asset('css/Customer/0 - Registration.css') }}" />
</head>
<body>



<div class="form-container">
    <h1>Sign <span>Up</span></h1>
    <form action="{{ route('customer.signupCustomer') }}" method="POST">
        @if(session()->has('error'))
            <p class="error-message">{{session('error')}}</p>
        @endif
        @csrf
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

        <input type="text" name="contact" id="contact" placeholder="Contact Number" required />
        <input type="email" name="email" id="email" placeholder="Email Address" required />
        <input type="password" name="password" placeholder="Password" required />
        <input type="password" name="cpassword" placeholder="Confirm Password" required />
        <button type="submit" id="submit">Sign Up</button>
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

</body>

<!-- <script src="{{ asset('js/Customer/0 - Registration.js') }}" type="module"></script> -->

</html>
