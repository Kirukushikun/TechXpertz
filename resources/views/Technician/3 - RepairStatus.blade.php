@include('components.technician-sidebar')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('css/Technician/technician-sidebar.css')}}">

    <link rel="stylesheet" href="{{asset('css/Technician/3 - RepairStatus.css')}}">

    <style>

        .modal{
            display: none;
        }
        .modal.active{
            position: fixed;
            right: 0;
            width: calc(100% - 270px);
            height: 100%;
            z-index: 1;
            background-color: rgba(0, 0, 0, 0.452);

            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-details.active{
            background-color: var(--primary-color);
            color: white;
        }.form-details.active i{
            color: white !important;
        }


    </style>
</head>
<body>
    <div class="dashboard">

        @yield('sidebar')

        <!-- Hidden Modal -->
        <div id="repairDetailsModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Repair Details</h2>
                <div id="repair-details-content">
                    <!-- Repair details will be dynamically injected here -->
                </div>
            </div>
        </div>

        <main class="main-content">
            <header>
                <h1>Repair Status</h1>
            </header>

            <div class="repair-navigation">
                <ul class="tabs">
                    <li class="tab-link active" data-tab="pending-repair">In Progress<i class="fa-solid fa-spinner"></i></li>
                    <li class="tab-link" data-tab="completed-repair">Completed<i class="fa-solid fa-check-double"></i></li>
                </ul>
            </div>

            <div class="tab-content">
                <div id="pending-repair" class="tab-content-item card active">
                    <table>
                        <thead>
                            <tr>
                                <th>Repair ID</th>
                                <th>Customer Name</th>
                                <th>Revenue</th>
                                <th>Expenses</th>
                                <th>Paid Status</th>
                                <th>Repair Status</th>
                                <th>Details</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Pending Repair Records will be populated here -->
                             @foreach($repairStatusPendingData as $pending)
                                <tr>
                                    <td>#{{$pending['repairID']}}</td>
                                    <td>{{$pending['customer_name']}}</td>
                                    <td>P {{$pending['revenue']}}</td>
                                    <td>P {{$pending['expenses']}} <i class="fa-regular fa-pen-to-square"></i></td>
                                    <td>
                                        <select class="paid-status">
                                            <option value="{{$pending['paid_status']}}">{{$pending['paid_status']}}</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="repair-status">
                                            <option value="{{$pending['repairstatus']}}">{{$pending['repairstatus']}}</option>
                                        </select>
                                    </td>
                                    <td><button class="view-repair" data-repair-id="{{$pending['repairID']}}">View</button></td>
                                    <td><a href="" class="terminate-btn">Terminate</a></td>
                                    <td><i class="fas fa-check"></i></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div id="completed-repair" class="tab-content-item card">
                    <table>
                        <thead>
                            <tr>
                                <th>Repair ID</th>
                                <th>Customer Name</th>
                                <th>Revenue</th>
                                <th>Expenses</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Completed Repair Records will be populated here -->
                            @foreach($repairStatusCompletedData as $completed)
                                <tr>
                                    <td>#{{$completed['repairID']}}</td>
                                    <td>{{$completed['customer_name']}}</td>
                                    <td>P {{$completed['revenue']}}</td>
                                    <td>P {{$completed['expenses']}} <i class="fa-regular fa-pen-to-square"></i></td>
                                    <td>
                                        {{$completed['paid_status']}}
                                    </td>
                                    <td>
                                        {{$completed['repairstatus']}}
                                    </td>
                                    <td><button>View</button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            
        </main>
    </div>
    
    <script src="{{asset('js/Technician/3 - RepairStatus.js')}}"></script>
    <script src="{{asset('js/Technician/technician-sidebar.js')}}"></script>
    <script>
        // Function to populate select inputs with options
        function populateSelectInputs() {
            const paidStatusOptions = [
            "Fully Paid",
            "Initially Paid",
            "Unpaid"
            ];

            const repairStatusOptions = [
            "Device Dropped Off",
            "Diagnosis In Progress",
            "Diagnosis Completed",
            "Repair In Progress",
            "Waiting For Parts",
            "Repair Completed",
            "Ready For Pickup",
            "Device Collected"
            ];

            const selectClasses = ["paid-status", "repair-status"];

            selectClasses.forEach(className => {
            const selects = document.querySelectorAll(`.${className}`);

            selects.forEach(select => {
                // Get the corresponding options array based on the class name
                const optionsArray = className === "paid-status" ? paidStatusOptions : repairStatusOptions;

                // Preserve the existing selected value
                const savedValue = select.value;

                // Clear existing options
                select.innerHTML = '';

                // Add an empty option at the top
                const emptyOption = document.createElement("option");
                emptyOption.value = '';
                emptyOption.textContent = '';
                select.appendChild(emptyOption);   


                // Add each option from the array
                optionsArray.forEach(option => {
                const newOption = document.createElement("option");
                newOption.value = option;
                newOption.textContent = option;

                // Set the saved value as selected if it matches
                if (option === savedValue) {
                    newOption.selected = true;
                }

                select.appendChild(newOption);
                });
            });
            });
        }

        // Call the function to populate the select inputs when the page loads
        populateSelectInputs();
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function(){
            const viewButtons = document.querySelectorAll('button.view-repair');

            viewButtons.forEach(button => {
                button.addEventListener('click', function (){
                    const repairID = this.getAttribute('data-repair-id');
                    fetchRepairDetails(repairID);
                    console.log('button is working', repairID);
                });
            });

            function fetchRepairDetails(repairID) {
                // Insert repairID dynamically into the URL
                fetch(`/technician/repairstatus/details/${repairID}`)
                    .then(response => response.json())
                    .then(data => {
                        displayModal(data);
                    })
            }

            function displayModal(data){
                const modal = document.getElementById('repairDetailsModal');
                const modalContent = document.getElementById('repair-details-content');

                modalContent.innerHTML = `
                    <p>Repair ID: ${data.ID}</p>
                    <p>Customer Name: ${data.customer_name}</p>
                    <p>Contact No: ${data.contact_no}</p>
                `;

                // Show the modal
                modal.classList.add("active");

                // Close modal when 'X' is clicked
                document.querySelector('.close').onclick = function () {
                    modal.classList.remove("active");
                };
            }
            
        });
    </script>

</body>
</html>
