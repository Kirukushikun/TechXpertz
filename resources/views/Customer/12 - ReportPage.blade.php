@include('components.header-footer')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechXpertz</title>
    <link rel="icon" href="{{ asset('images/TechXpertz-Icon.ico') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/Customer/customer-headerfooter.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Customer/customer-loadingscreen.css') }}">

    <link rel="stylesheet" href="{{ asset('css/Customer/12 - ReportPage.css') }}">
</head>
<body>
    @yield('header')
    <div class="report-content">
        <div class="upper-content">
            <h1>Report a <span>Problem</span></h1>
            <p>Encountered an issue? Let us know, and our team will work to resolve it as quickly as possible. Your feedback helps us improve our service and provide a better experience for everyone.</p>
        </div>

        <form class="lower-content">
            <div class="form-section">
                <div class="form-group">
                    <label for="firstname">First Name</label>
                    <input type="text" id="firstname" name="firstname" value="{{Auth::user()->firstname ?? ''}}" required> 
                </div>
                <div class="form-group">
                    <label for="lastname">Last Name</label>
                    <input type="text" id="lastname" name="lastname" value="{{Auth::user()->lastname ?? ''}}" required>
                </div>                
            </div>
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" value="{{Auth::user()->email ?? ''}}" required>
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <select type="category" id="category" name="category" required>
                    <option value="Account Issues">Account Issues</option>
                    <option value="Content & Information">Content & Information</option>
                    <option value="Messages and Notifications">Messages and Notifications</option>
                    <option value="Privacy & Security">Privacy & Security</option>
                    <option value="Ratings & Reviews">Ratings & Reviews</option>
                    <option value="Repair Shop Information">Repair Shop Information</option>
                    <option value="Search & Filters"> Search & Filters</option>
                    <option value="Technical Errors">Technical Errors</option>
                    <option value="Technician Performance">Technician Performance</option>
                    <option value="User Interface (UI) & User Experience (UX)">User Interface (UI) & User Experience (UX)</option>
                    <option value="Website Performance">Website Performance</option>
                </select>
            </div>
            <div class="form-group">
                <label for="sub-category">Sub Category</label>
                <select type="sub-category" id="sub-category" name="sub-category" required>
                    <option value=""></option>
                </select>
            </div>
            <div class="form-group">
                <label for="message">What seems to be the problem?</label>
                <textarea name="message" class="message" id="message" cols="25" rows="7" ></textarea>  
            </div>
            <input type="submit" class="submit" value="SUBMIT">
        </form>
    </div>
    @yield('footer')
    <script>
        let mainCategory = document.getElementById('category');
        let subCategory = document.getElementById('sub-category');
        let subCategoryContents = {
            "Account Issues": [
                "I can't log in to my account.",
                "I'm having trouble signing up.",
                "I can't reset my password.",
                "I'm not receiving my account verification email.",
                "I can't update my profile details.",
                "My account is suspended or banned.",
                "Other"
            ],
            "Content & Information": [
                "Some content on the site is inaccurate.",
                "There are grammar or spelling mistakes.",
                "I noticed outdated information.",
                "Some information seems to be missing.",
                "Other"
            ],
            "Messages and Notifications": [
                "Messages are delayed or not showing up.",
                "I'm not receiving notifications.",
                "I can't access my messages or chat.",
                "I'm getting spam or unwanted messages.",
                "Other"
            ],
            "Privacy & Security": [
                "I'm concerned about privacy on this site.",
                "Someone else accessed my account.",
                "I think there's a security issue.",
                "I noticed suspicious or spam activity.",
                "Other"
            ],
            "Ratings & Reviews": [
                "I can't submit my review or rating.",
                "Some reviews are missing or not displayed.",
                "There are inappropriate or fake reviews.",
                "The rating system doesn't seem to be working.",
                "Other"
            ],
            "Repair Shop Information": [
                "The shop information (like contact info) is incorrect.",
                "Shop hours or availability seem outdated.",
                "Photos or logos for the shop are missing.",
                "Shop descriptions are incomplete.",
                "Other"
            ],
            "Search & Filters": [
                "The search results aren't relevant to my query.",
                "Filters aren't working as expected.",
                "I can't sort listings the way I want.",
                "Some filters I need are missing.",
                "Other"
            ],
            "Technical Errors": [
                "I'm getting an error message.",
                "There's a code or JavaScript error.",
                "I can't submit forms on the site.",
                "There's an issue with the database or storage.",
                "Other"
            ],
            "Technician Performance": [
                "The technician was unresponsive or delayed.",
                "The technician didn’t meet quality expectations.",
                "The technician was unprofessional or rude.",
                "The technician didn’t show up as scheduled.",
                "There was an issue with the pricing or service terms.",
                "I’m concerned about the technician’s expertise.",
                "The technician left a mess or damaged something.",
                "The technician canceled at the last minute.",
                "I have other concerns about this technician.",
                "Other"
            ],
            "User Interface (UI) & User Experience (UX)": [
                "I'm having trouble navigating the site.",
                "The layout or design is confusing.",
                "The text is too small or hard to read.",
                "The site doesn't look right on my mobile device.",
                "I'm experiencing accessibility issues.",
                "Other"
            ],
            "Website Performance": [
                "The website is loading very slowly.",
                "The website keeps crashing or freezing.",
                "I'm seeing broken links or missing pages.",
                "Images or graphics aren't loading properly.",
                "My data isn't syncing across my devices.",
                "Other"
            ],
        }

        // Define the function to populate sub-categories
        function populateSubCategories() {
            // Clear any existing options in the sub-category dropdown
            subCategory.innerHTML = '';

            // Get the selected main category value
            let selectedCategory = mainCategory.value;

            // Retrieve the corresponding sub-category list
            let subCategories = subCategoryContents[selectedCategory];

            // Populate sub-category dropdown if there are sub-categories
            if (subCategories) {
                subCategories.forEach(subCat => {
                    let option = document.createElement('option');
                    option.value = subCat;
                    option.textContent = subCat;
                    subCategory.appendChild(option);
                });
            }
        }

        // Add an event listener to the main category dropdown to trigger sub-category update
        mainCategory.addEventListener('change', populateSubCategories);

        // Optionally, call the function initially to set sub-categories on page load
        populateSubCategories();
    </script>
    <script src="{{asset('js/Customer/header-footer.js')}}" defer></script>
    <script src="{{asset('js/Customer/customer-loadingscreen.js')}}" defer></script>
</body>
</html>