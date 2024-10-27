document.addEventListener('DOMContentLoaded', function(){


    const appointmentActions = document.querySelectorAll('a.appointment-btn');

    appointmentActions.forEach(button => {
        button.addEventListener('click', function (){
            const appointmentID = this.getAttribute('data-appointment-id');
            const customerID = this.getAttribute('data-customer-id');
            const appointmentSTATUS = this.getAttribute('data-appointment-status');
            verifyChanges(appointmentID, appointmentSTATUS, customerID);
            console.log('button is working', appointmentID, appointmentSTATUS);
        });
    });

    function verifyChanges(appointmentID, appointmentSTATUS, customerID){
        const modal = document.getElementById('modal');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if(appointmentSTATUS === "confirm"){
            modal.innerHTML = `
                <form action="/technician/appointment/${appointmentSTATUS}/${appointmentID}" method="POST">
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
                <form action="/technician/appointment/${appointmentSTATUS}/${appointmentID}" method="POST">
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
                <form action="/technician/repairstatus/create/${appointmentID}/${customerID}" method="POST">
                    <input type="hidden" name="_token" value="${csrfToken}">
                    <div class="modal-verification">
                        <i class="fa-solid fa-screwdriver-wrench" id="repair"></i>
                        <div class="verification-message">
                            <h2>Start Repair</h2>
                            <p>Are you sure you want to start the repair for this appointment?</p>             
                        </div>
                        <div class="verification-content">
                            <h3>Additional Details</h3>
                            <div class="row">
                                <div class="form-group">
                                    <label for="paid_status">Paid Status</label>
                                    <select id="paid_status" name="paid_status">
                                        <option value="Unpaid">Unpaid</option>
                                        <option value="Initially Paid">Initially Paid</option>
                                        <option value="Fully Paid">Fully Paid</option>
                                    </select>
                                </div>                            
                            </div>
                            <!-- Only accept number -->
                            <div class="row">
                                <div class="form-group">
                                    <label for="revenue">Repair Cost (Optional)</label>
                                    <input type="text" id="revenue" name="revenue">
                                </div>
                                <div class="form-group">
                                    <label for="expenses">Expenses (Optional)</label>
                                    <input type="text" id="expenses" name="expenses"> 
                                </div>                                
                            </div>                      
                        </div>

                        <div class="verification-action">
                            <button type="submit" class="submit">Confirm Start</button>
                            <button type="button" class="normal"><b>Dismiss</b></button>
                        </div>

                        <p class="note"><b>Note: </b>Do not start the repair unless the device has been dropped off.<br>Starting the repair will automatically notify the customer that the device has been received.</p>   
                    </div>                 
                </form>
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
