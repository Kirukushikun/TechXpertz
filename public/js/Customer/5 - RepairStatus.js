let modal = document.getElementById('modal');
let cancelBtn = document.getElementById('cancel-appointment');
let rateBtn = document.getElementById('rate-repair');
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');


if(cancelBtn){
    cancelBtn.addEventListener('click', function(){
        let repairID = this.getAttribute('data-repair-id');
        modal.innerHTML = `
            <form action="/bookappointment/cancel/${repairID}" method="POST">
                <input type="hidden" name="_token" value="${csrfToken}">
                <input type="hidden" name="_method" value="PATCH">

                <div class="modal-verification">
                    <i class="fa-solid fa-triangle-exclamation" id="repair"></i>
                    <div class="verification-message">
                        <h2>Cancel Request</h2>
                        <p>Are you sure you want to cancel your request?</p>                        
                    </div>
                    <div class="verification-action">
                        <button type="submit" class="submit">Cancel Appointment</button>
                        <button type="button" class="close normal"><b>Dismiss</b></button>
                    </div>
                </div>                 
            </form>
        `;

        modal.classList.add('active');

        document.querySelector('.close').onclick = function () {
            modal.classList.remove('active');
        };
    });    
}

if(rateBtn){
    rateBtn.addEventListener('click', function(){
        let technicianID = this.getAttribute('data-technician-id');
        let repairID = this.getAttribute('data-repair-id');

        modal.innerHTML = `
            <form action="/review/${technicianID}" class="review-form" method="POST">
                <input type="hidden" name="_token" value="${csrfToken}">

                <input type="text" id="rating" name="rating" hidden>
                <input type="text" id="repairID" name="repairID" value="${repairID}" hidden>

                <div class="left">
                    <div class="review-header">
                        <h2>How would you rate our service?</h2>
                        <p>Please rate your experience with the repair service from the repair shop and provide a feedback.</p>
                    </div>
                    
                    <div class="review-rating">
                        <div class="star-container" id="starContainer">
                            <i class="fa-regular fa-star star" data-value="1"></i>
                            <i class="fa-regular fa-star star" data-value="2"></i>
                            <i class="fa-regular fa-star star" data-value="3"></i>
                            <i class="fa-regular fa-star star" data-value="4"></i>
                            <i class="fa-regular fa-star star" data-value="5"></i>
                        </div>                
                    </div>

                    <div class="review-comment">
                        <h4>Comment:</h4>
                        <textarea class="comment" name="comment" id="comment"></textarea>
                    </div>

                    <div class="review-action">
                        <button type="submit">Submit</button>
                        <a href="#" class="close">Maybe, later</a>
                    </div>
                    
                </div>

                <div class="right">
                    <!-- You can add more content here if needed -->
                </div>
            </form> 
        `;

        rate();

        modal.classList.add('active');

        document.querySelector('.close').onclick = function (e) {
            e.preventDefault(); // Prevents anchor default action
            modal.classList.remove('active');
        };
    }); 
}

function rate(){
    const stars = document.querySelectorAll('.star');
    let currentRating = 0;

    // Function to fill the stars up to the given rating
    const fillStars = (rating) => {
        stars.forEach(star => {
            if (parseInt(star.getAttribute('data-value')) <= rating) {
                star.classList.add('fa-solid');
                star.classList.remove('fa-regular');
            } else {
                star.classList.remove('fa-solid');
                star.classList.add('fa-regular');
            }
        });
    };

    // Handle star hover
    stars.forEach(star => {
        star.addEventListener('mouseover', (e) => {
            const hoverRating = parseInt(e.target.getAttribute('data-value'));
            fillStars(hoverRating);
        });

        // Handle star click
        star.addEventListener('click', (e) => {
            currentRating = parseInt(e.target.getAttribute('data-value'));
            document.getElementById('rating').value = currentRating; // Set the hidden rating input value
            fillStars(currentRating);
        });

        // Reset stars to current rating on mouseout
        star.addEventListener('mouseout', () => {
            fillStars(currentRating);
        });
    });
}