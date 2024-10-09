document.addEventListener('DOMContentLoaded', function(){
    function verifyChanges(appointmentID, appointmentSTATUS, customerID){
        const modal = document.getElementById('modal');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if(appointmentSTATUS === "confirm"){
            modal.innerHTML = `
            <form method="POST">
                <input type="hidden" name="_token" value="${csrfToken}">
                <input type="hidden" name="_method" value="PATCH">
                
                <div class="modal-verification">
                    <i class="fa-solid fa-circle-check" id="check"></i>
                    <div class="verification-message">
                        <h2>Confirm Appointment</h2>
                        <p>Are you sure you want to confirm this appointment?</p>
                    </div>
                    <div class="verification-action">
                        <button type="submit" class="success">Confirm Appointment</button>
                        <button type="button" class="normal"><b>Dismiss</b></button>
                    </div>
                </div>                
            </form>
            `;                
        }else if(appointmentSTATUS === "reject"){
            modal.innerHTML = `
            <form method="POST">
                <input type="hidden" name="_token" value="${csrfToken}">
                <input type="hidden" name="_method" value="PATCH">

                <div class="modal-verification">
                    <i class="fa-solid fa-triangle-exclamation" id="exclamation"></i>
                    <div class="verification-message">
                        <h2>Reject Appointment</h2>
                        <p>Are you sure you want to Reject this appointment?</p>                        
                    </div>
                    <div class="verification-action">
                        <button type="submit" class="danger">Confirm Rejection</button>
                        <button type="button" class="normal"><b>Dismiss</b></button>
                    </div>
                </div>                 
            </form>
            `;   
        }else if(appointmentSTATUS === "cancel"){
            modal.innerHTML = `
                <form action="/technician/appointment/${appointmentSTATUS}/${appointmentID}" method="POST">
                    <input type="hidden" name="_token" value="${csrfToken}">
                    <input type="hidden" name="_method" value="PATCH">

                    <div class="modal-verification">
                        <i class="fa-solid fa-triangle-exclamation" id="exclamation"></i>
                        <div class="verification-message">
                            <h2>Cancel Appointment</h2>
                            <p>Are you sure you want to Cancel this appointment?</p>                        
                        </div>
                        <div class="verification-action">
                            <button type="submit" class="danger">Confirm Cancellation</button>
                            <button type="button" class="normal"><b>Dismiss</b></button>
                        </div>
                    </div>                 
                </form>
            `;   
        }else if(appointmentSTATUS === "repair"){
            modal.innerHTML = `
                <div class="form">
                    <div class="modal-verification">
                        <i class="fa-solid fa-circle-check" id="repair"></i>
                        <div class="verification-message">
                            <h2>Confirm Save Changes</h2>
                            <p>Are you sure you want to save these changes?</p>
                        </div>
                        <div class="verification-action">
                            <button type="submit" class="submit" id="save-changes">Save Changes</button>
                            <button type="button" class="normal"><b>Dismiss</b></button>
                        </div>
                    </div>                
                </div>
            `;   
        }

        // Show the modal
        modal.classList.add("active");

        // Close modal when 'X' is clicked
        document.querySelector('.normal').onclick = function () {
            modal.classList.remove("active");
        };
    }
});