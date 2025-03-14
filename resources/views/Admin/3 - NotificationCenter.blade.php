@include('components.admin-sidebar')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="icon" href="{{ asset('images/TechXpertz-Icon.ico') }}">
    <!-- Crucial Part on every forms -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Crucial Part on every forms/ -->
    <link rel="stylesheet" href="{{ asset('css/Admin/3 - NotificationCenter.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Admin/admin-sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Admin/admin-modal.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="dashboard">

        <!-- MODAL POPUP -->
        <div class="modal" id="modal">

        </div>

        @yield('sidebar')

        <main class="main-content">

            <div class="head">
                <div class="logo">
                    <h2>Tech<span>X</span>pertz</h2>
                </div>

                @yield('navbar')

            </div>

            <div class="body">
                <div class="header">
                    <h1>Notification Center</h1>
                </div>

                <div class="content">
                    
                    <div class="form-notification card">
                        <div class="form-group">
                            <label for="target-type">Target Type</label>
                            <select id="target-type" name="target-type">
                                <option value="Public">Public</option>
                                <option value="Technicians">Technicians</option>
                                <option value="Customers">Customers</option>
                            </select>
                        </div>

                        <div class="form-section">
                            <div class="form-group">
                                <label for="target-user">Target User</label>
                                <select id="target-user" name="target-user"> 
                                    <option value="All">All</option>
                                    <option value="Specific">Specific</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="target-id">Target ID</label>
                                <input type="text" id="target-id" name="target-id" placeholder="">
                            </div>                            
                        </div>

                
                        <div class="form-group">
                            <label for="title">Notification Title</label>
                            <input type="text" id="title" name="title" placeholder="Enter notification title">
                        </div>

                        <div class="form-group">
                            <label for="message">Notification Message</label>
                            <textarea id="message" name="message" rows="5" placeholder="Enter your message"></textarea>
                        </div>
                
                        <!-- Send Notification Button -->
                        <button type="button" class="notification-btn">Send Notification</button>
                    </div>

                    <div class="user-reference card">

                        <div class="tab-filters">
                            <!-- <li><button><i class="fa-solid fa-filter"></i> Filter</button></li> -->
                            <li><i class="fa-solid fa-magnifying-glass" id="search"></i> <input id="search-input" type="text" placeholder="search"></li>
                        </div>

                        <table id="users-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($allUsers as $user)
                                    <tr>
                                        <td>{{$user['id']}}</td>
                                        <td>{{$user['fullname']}}</td>
                                        <td>
                                            {{$user['email']}}
                                        </td>
                                        <td>
                                            {{$user['role']}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div id="pagination" class="pagination">
                        </div>
                    </div>

                </div>

                <div class="notification-history card">
                    <div class="card-header">
                        <h2>Notification History</h2>
                        <!-- <div class="tab-filters">
                            <li><button><i class="fa-solid fa-filter"></i> Filter</button></li>
                            <li><i class="fa-solid fa-magnifying-glass" id="search"></i> <input type="text" placeholder="search"></li>
                        </div>                         -->
                    </div>
                    <div class="notification-container">
                        @foreach($notificationHistory as $notification)
                        <div class="notification-item">
                            <div class="notification-header">
                                <div class="left">
                                    <div class="title">
                                        {{$notification->title}}
                                    </div>
                                    <div class="sub-title">
                                        Sent to:
                                        @if($notification->target_type == "Public")
                                        <span class="{{$notification->target_type}}">{{$notification->target_type}}</span> |
                                        <span>{{ $notification->created_at->format('M d, Y, h:i A') }}</span>
                                        @else
                                            <span>{{$notification->target_type}}</span> |
                                            @if($notification->target_user == "All")
                                            <span>Target User: All</span> |
                                            <span>{{ $notification->created_at->format('M d, Y, h:i A') }}</span> 
                                            @else
                                            <span>Target User: #{{$notification->target_id}}</span> |
                                            <span>{{ $notification->created_at->format('M d, Y, h:i A') }}</span> 
                                            @endif                                   
                                        @endif

                                    </div>                                
                                </div>

                                <!-- <div class="right">
                                    <a href=""><i class="fa-regular fa-pen-to-square"></i></a>
                                    <a href=""><i class="fa-regular fa-trash-can"></i></a>
                                </div> -->
                            </div>
                            <div class="notification-content">
                                {{$notification->message}}
                            </div>
                        </div>
                        @endforeach                        
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="{{ asset('js/Admin/admin-navbars.js') }}"></script>

    <script>
        const modal = document.getElementById('modal');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        //Form Notification Inputs
        const inputTargetType = document.getElementById('target-type');
        const inputTargetUser = document.getElementById('target-user');
        const inputTargetID = document.getElementById('target-id');
        const inputTitle = document.getElementById('title');
        const inputMessage = document.getElementById('message');
        

        //Notification Button
        let notificationButton = document.querySelector('button.notification-btn');

        notificationButton.addEventListener('click', function(){
 
            if(inputTargetType.value == "Public"){
                modal.innerHTML = `
                    <form action="/admin/notificationcenter/${inputTargetType.value}" method="POST">
                        <input type="hidden" name="_token" value="${csrfToken}">
                        
                        <div class="modal-verification">
                            <i class="fa-solid fa-circle-check sign-success" ></i>
                            <div class="verification-message">
                                <h2>Confirm Notification</h2>
                                <p>Are you sure you want to send this notification to the user? <br> Once sent, the user will be alerted immediately.</p>
                            </div>
                            <div class="verification-content">
                                <div class="form-group">
                                    <label for="target_type">Target Type</label>
                                    <input type="text" id="target_type" name="target_type" value="${inputTargetType.value}" readonly required>
                                </div>
                                <div class="form-group">
                                    <label for="notification_title">Notification Title</label>
                                    <input type="text" id="notification_title" name="notification_title" value="${inputTitle.value}" required>
                                </div>
                                <div class="form-group">
                                    <label for="notification_message">Notification Message</label>
                                    <textarea type="text" id="notification_message" name="notification_message" required>${inputMessage.value}</textarea>
                                </div>
                            </div>
                            <div class="verification-action">
                                <button type="submit" class="success btn-success">Confirm Notification</button>
                                <button type="button" class="normal btn-normal"><b>Dismiss</b></button>
                            </div>
                        </div>                
                    </form>
                `;

            } else{

                if(inputTargetUser.value == "All"){
                    modal.innerHTML = `
                        <form action="/admin/notificationcenter/${inputTargetType.value}" method="POST">
                            <input type="hidden" name="_token" value="${csrfToken}">          
                            
                            <div class="modal-verification">
                                <i class="fa-solid fa-circle-check sign-success" ></i>
                                <div class="verification-message">
                                    <h2>Confirm Notification</h2>
                                    <p>Are you sure you want to send this notification to the user? <br> Once sent, the user will be alerted immediately.</p>
                                </div>
                                <div class="verification-content">
                                    <div class="form-group">
                                        <label for="target_type">Target Type</label>
                                        <input type="text" id="target_type" name="target_type" value="${inputTargetType.value}" readonly>
                                    </div> 

                                    <div class="form-group">
                                        <label for="target_user">Target User</label>
                                        <input type="text" id="target_user" name="target_user"  value="${inputTargetUser.value}" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="notification_title">Notification Title</label>
                                        <input type="text" id="notification_title" name="notification_title"  value="${inputTitle.value}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="notification_message">Notification Message</label>
                                        <textarea type="text" id="notification_message" name="notification_message" required>${inputMessage.value}</textarea>
                                    </div>
                                </div>
                                <div class="verification-action">
                                    <button type="submit" class="success btn-success">Confirm Notification</button>
                                    <button type="button" class="normal btn-normal"><b>Dismiss</b></button>
                                </div>
                            </div>                
                        </form>
                    `;
                }else{
                    modal.innerHTML = `
                        <form action="/admin/notificationcenter/${inputTargetType.value}" method="POST">
                            <input type="hidden" name="_token" value="${csrfToken}">          
                            
                            <div class="modal-verification">
                                <i class="fa-solid fa-circle-check sign-success" ></i>
                                <div class="verification-message">
                                    <h2>Confirm Notification</h2>
                                    <p>Are you sure you want to send this notification to the user? <br> Once sent, the user will be alerted immediately.</p>
                                </div>
                                <div class="verification-content">
                                    <div class="form-group">
                                        <label for="target_type">Target Type</label>
                                        <input type="text" id="target_type" name="target_type" value="${inputTargetType.value}" readonly>
                                    </div>

                                    <div class="form-section">
                                        <div class="form-group">
                                            <label for="target_user">Target User</label>
                                            <input type="text" id="target_user" name="target_user"  value="${inputTargetUser.value}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="target_id">Target ID</label>
                                            <input type="text" id="target_id" name="target_id"  value="${inputTargetID.value}" required>
                                        </div>                            
                                    </div>

                                    <div class="form-group">
                                        <label for="notification_title">Notification Title</label>
                                        <input type="text" id="notification_title" name="notification_title" value="${inputTitle.value}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="notification_message">Notification Message</label>
                                        <textarea type="text" id="notification_message" name="notification_message" required>${inputMessage.value}</textarea>
                                    </div>
                                </div>
                                <div class="verification-action">
                                    <button type="submit" class="success btn-success">Confirm Notification</button>
                                    <button type="button" class="normal btn-normal"><b>Dismiss</b></button>
                                </div>
                            </div>                
                        </form>
                    `;
                }

            }
            modal.classList.add("active");

            // Close modal when 'X' is clicked
            document.querySelector('.normal').onclick = function () {
                modal.classList.remove("active");
            };
        });

        //Disable Target User and Target ID if Target Type is Public
        if(inputTargetType.value == "Public"){
            inputTargetUser.disabled = true;
            inputTargetID.disabled = true;
        }else{
            inputTargetUser.disabled = false;
        }

        //Disable Target ID if Target User is All
        if(inputTargetUser.value == "All"){
            inputTargetID.disabled = true;
        }else{
            inputTargetID.disabled = false;
        }
        
        //Disable on every change
        inputTargetType.addEventListener('change', function(){
            if(this.value == "Public" ){
                inputTargetUser.disabled = true;
                inputTargetID.disabled = true;
            }else{
                inputTargetUser.disabled = false;
                inputTargetID.disabled = true;
            }
            inputTargetUser.value = "All";
            inputTargetID.value = "";
        })

        inputTargetUser.addEventListener('change', function(){
            if(this.value == "All"){
                inputTargetID.disabled = true;
            }else{
                inputTargetID.disabled = false;
            }
            inputTargetID.value = "";
        })

    </script>

    <script>
        // Configuration Variables
        const tableId = "users-table"; // ID of the table
        const paginationContainerId = "pagination"; // ID of the pagination container
        const searchInputId = "search-input"; // ID of the search input
        const itemsPerPage = 6; // Items per page

        let currentPage = 1; // Initial page number

        // Function to display items for the table
        function displayTableContent(page = 1, search = "") {
            const table = document.getElementById(tableId);
            if (!table) return;

            const rows = Array.from(table.querySelector("tbody").rows);
            const filteredRows = search
                ? rows.filter(row => row.textContent.toLowerCase().includes(search.toLowerCase()))
                : rows;

            const totalItems = filteredRows.length;
            const start = (page - 1) * itemsPerPage;
            const end = page * itemsPerPage;

            // Hide all rows and show only the filtered rows for the current page
            rows.forEach(row => (row.style.display = "none"));
            filteredRows.slice(start, end).forEach(row => (row.style.display = ""));

            // Update pagination controls
            renderPagination(page, Math.ceil(totalItems / itemsPerPage));
        }

        // Function to render pagination
        function renderPagination(currentPage, totalPages) {
            const paginationContainer = document.getElementById(paginationContainerId);
            paginationContainer.innerHTML = "";

            const maxPagesToShow = 5;
            let startPage = Math.max(1, currentPage - Math.floor(maxPagesToShow / 2));
            let endPage = startPage + maxPagesToShow - 1;

            if (endPage > totalPages) {
                endPage = totalPages;
                startPage = Math.max(1, endPage - maxPagesToShow + 1);
            }

            // Create "Previous" button
            if (currentPage > 1) {
                const prevButton = document.createElement("button");
                prevButton.innerHTML = '<i class="fa-solid fa-caret-left"></i>';
                prevButton.addEventListener("click", () => {
                    currentPage -= 1;
                    displayTableContent(currentPage, document.getElementById(searchInputId).value.trim());
                });
                paginationContainer.appendChild(prevButton);
            }

            // Create page number buttons
            for (let i = startPage; i <= endPage; i++) {
                const pageButton = document.createElement("button");
                pageButton.textContent = i;
                pageButton.classList.toggle("active", i === currentPage);
                pageButton.addEventListener("click", () => {
                    currentPage = i;
                    displayTableContent(currentPage, document.getElementById(searchInputId).value.trim());
                });
                paginationContainer.appendChild(pageButton);
            }

            // Create "Next" button
            if (currentPage < totalPages) {
                const nextButton = document.createElement("button");
                nextButton.innerHTML = '<i class="fa-solid fa-caret-right"></i>';
                nextButton.addEventListener("click", () => {
                    currentPage += 1;
                    displayTableContent(currentPage, document.getElementById(searchInputId).value.trim());
                });
                paginationContainer.appendChild(nextButton);
            }
        }

        // Search input event listener
        document.getElementById(searchInputId).addEventListener("input", () => {
            currentPage = 1;
            displayTableContent(currentPage, document.getElementById(searchInputId).value.trim());
        });

        // Initial display for the table
        displayTableContent(currentPage);

    </script>
</body>
</html>
