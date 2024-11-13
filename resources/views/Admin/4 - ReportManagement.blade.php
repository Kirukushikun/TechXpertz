@include('components.admin-sidebar')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Manager</title>
    <!-- Crucial Part on every forms -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Crucial Part on every forms/ -->
    <link rel="stylesheet" href="{{ asset('css/Admin/4 - ReportManagement.css') }}">
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
                    <h1>Report Management</h1>
                    
                    <div class="tab-filters">
                        <li><button><i class="fa-solid fa-filter"></i>Filter</button></li>
                        <li><i class="fa-solid fa-magnifying-glass" id="search"></i> <input type="text" id="search-input" placeholder="search"></li>
                        <a class="add-repair"><i class="fa-solid fa-plus" id="add-appointment"></i></a>
                    </div>
                </div>
                <!-- <div class="sub-header">
                    <div class="report-card">
                        Total Reports
                    </div>
                    <div class="report-card">
                        Resolved Reports
                    </div>
                    <div class="report-card">
                        Pending Reports
                    </div>
                    <div class="report-card">
                        Escalated Reports
                    </div>
                </div> -->
                <div class="body">
                    <ul class="tabs">
                        <div class="tab-navigation">
                            <li class="tab-link active" data-tab="all-users" data-table="all-users-table">All Users</li>
                            <li class="tab-link" data-tab="user-customer" data-table="user-customer-table">Customers</li>
                            <li class="tab-link" data-tab="user-technician" data-table="user-technician-table">Technicians</li>
                        </div>

                        @php
                            $pendingReports = $reports->where('report_status', 'Pending');
                            $resolvedReports = $reports->where('report_status', 'Resolved');
                            $escalatedReports = $reports->where('report_status', 'Escalated');
                        @endphp

                        <div class="tab-summary">
                            <p>Total Reports: {{$reports->count()}}</p>
                            <p>Pending Reports: {{$pendingReports->count()}}</p>
                            <p>Resolved Reports: {{$resolvedReports->count()}}</p>
                            <p>Escalated Reports: {{$escalatedReports->count()}}</p>
                        </div>
                    </ul>

                    <div class="tab-content">
                        <!-- All Users -->
                        <div id="all-users" class="tab-content-item card active">
                            <table id="all-users-table">
                                <thead>
                                    <tr>
                                        <th>Report ID</th>
                                        <th>Name</th>
                                        <th>User Type</th>
                                        <th>Issue</th>
                                        <th>Status</th>
                                        <th>Date Submitted</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($reports as $report)
                                    <tr>
                                        <td>{{$report->id}}</td>
                                        <td>{{$report->user_name}}</td>
                                        <td>{{$report->user_role}}</td>
                                        <td>
                                            {{$report->category}}
                                        </td>
                                        <td>
                                            <input type="text" value="{{$report->report_status}}">
                                        </td>
                                        <td>
                                            {{ $report->created_at->format('M d, Y, h:i A') }}
                                        </td>
                                        <td>
                                            <button class="report-details" data-report-id="{{$report->id}}">View</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="pagination">
                            </div> 
                        </div>

                        <!-- Customers -->
                        <div id="user-customer" class="tab-content-item card">
                            <table id="user-customer-table">
                                <thead>
                                    <tr>
                                        <th>Report ID</th>
                                        <th>Name</th>
                                        <th>Issue</th>
                                        <th>Status</th>
                                        <th>Date Submitted</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($customerReports as $creport)
                                    <tr>
                                        <td>{{$creport->id}}</td>
                                        <td>{{$creport->user_name}}</td>
                                        <td>
                                            {{$creport->report_issue}}
                                        </td>
                                        <td>
                                            <input type="text" value="{{$creport->report_status}}">
                                        </td>
                                        <td>
                                            {{ $creport->created_at->format('M d, Y, h:i A') }}
                                        </td>
                                        <td>
                                            <button class="report-details" data-report-id="{{$creport->id}}">View</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="pagination">
                            </div>                            
                        </div>

                        <!-- Technician -->
                        <div id="user-technician" class="tab-content-item card">
                            <table id="user-customer-table">
                                <thead>
                                    <tr>
                                        <th>Report ID</th>
                                        <th>Name</th>
                                        <th>Issue</th>
                                        <th>Status</th>
                                        <th>Date Submitted</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($technicianReports as $treport)
                                    <tr>
                                        <td>{{$treport->id}}</td>
                                        <td>{{$treport->user_name}}</td>
                                        <td>
                                            {{$treport->category}}
                                        </td>
                                        <td>
                                            <input type="text" value="{{$treport->report_status}}">
                                        </td>
                                        <td>
                                            {{ $treport->created_at->format('M d, Y, h:i A') }}
                                        </td>
                                        <td>
                                            <button class="report-details" data-report-id="{{$treport->id}}">View</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="pagination">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="{{ asset('js/Admin/4 - ReportManagement.js') }}" defer></script>
    <script src="{{ asset('js/Admin/admin-navbars.js') }}"></script>
    <script>
        const modal = document.getElementById('modal');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        const reportdetailButtons = document.querySelectorAll('button.report-details');
        reportdetailButtons.forEach(button => {
            button.addEventListener('click', function(){
    
                let reportID = button.getAttribute("data-report-id");
                fetchreportDetails(reportID);

            })
        });

        function fetchreportDetails(reportID){
            fetch(`/admin/notificationcenter/details/${reportID}`)
                .then(response => response.json())
                .then(data => {
                    displayreportDetails(data);
                })
        }

        function displayreportDetails(data){
            modal.innerHTML = `
                <form action="/admin/notificationcenter/update/${data.ID}" method="POST">
                    <input type="hidden" name="_token" value="${csrfToken}">          
                    <input type="hidden" name="_method" value="PATCH">

                    <div class="modal-verification">
                        <!-- <i class="fa-solid fa-circle-check" id="check"></i> -->
                        <div class="verification-message">
                            <h2>Report Details</h2>
                        </div>
                        <div class="verification-content">
                            <div class="form-section">
                                <div class="form-group">
                                    <label for="user_id">User ID</label>
                                    <input type="text" id="user_id" name="user_id" value="${data.user_id}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="user_role">User Role</label>
                                    <input type="text" id="user_role" name="user_role" value="${data.user_role}" readonly>
                                </div>                            
                            </div>
                            <div class="form-section">
                                <div class="form-group">
                                    <label for="user_name">User Name</label>
                                    <input type="text" id="user_name" name="user_name" value="${data.user_name}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="user_email">User Email</label>
                                    <input type="text" id="user_email" name="user_email" value="${data.user_email}" readonly>
                                </div>                            
                            </div>

                            <div class="form-group">
                                <label for="report_status">Report Status</label>
                                <select name="report_status" id="report_status">
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="report_issue">Category</label>
                                <input type="text" id="report_issue" name="report_issue" value="${data.category}" readonly>
                            </div>

                            
                            <div class="form-group">
                                <label for="report_issue">Sub-Category</label>
                                <input type="text" id="report_issue" name="report_issue" value="${data.sub_category}" readonly>
                            </div>

                            <div class="form-group">
                                <label for="report_description">Report Description</label>
                                <textarea type="text" id="report_description" name="report_description" readonly>${data.description}</textarea>
                            </div>
                        </div>
                        
                        <div class="verification-action">
                            <button type="submit" class="success">Update Report</button>
                            <button type="button" class="normal"><b>Dismiss</b></button>
                        </div>
                    </div>                
                </form>
            `
            $reportStatus = document.getElementById('report_status');
            ["Pending", "Resolved", "Escalated"].forEach(status => {
                const option = document.createElement("option");
                option.value = status;
                option.textContent = status;

                if(status == data.report_status){
                    option.selected = true;
                }

                $reportStatus.appendChild(option);
            });

            modal.classList.add("active");

            // Close modal when 'X' is clicked
            document.querySelector('.normal').onclick = function () {
                modal.classList.remove("active");
            }; 
        }
    </script>
</body>
</html>
