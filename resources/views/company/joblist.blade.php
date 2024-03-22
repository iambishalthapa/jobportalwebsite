<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Job List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 1300px; /* Adjust the max-width value as needed */
            margin: 0 224px !important; /* Center the container */
            height: 100hv;
        }

        .close-button {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
        }

        h2 {
            color: #007bff;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .table th, .table td {
            text-align: center;
        }

        .btn-info, .btn-warning, .btn-danger {
            margin-right: 5px;
        }

        .pagination {
            justify-content: center;
        }

        .page-link {
            color: #007bff;
        }

        .page-item.active .page-link {
            background-color: #007bff;
            border-color: #007bff;
        }

        .page-link:hover {
            color: #0056b3;
        }

        /* Custom styles for advanced layout */
        .search-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        #showDropdown {
            width: 75px;
        }

        #search {
            max-width: 150px;
        }

        .btn-search {
            margin-left: 10px;
        }

        .btn-actions button {
            margin-right: 5px;
        }
    </style>
</head>
<body>
@include('company.navigationbar')
<div class="container mt-5">
    <h2 class="mb-4">My Company Job List</h2>

    <!-- Search bar -->
    <div class="search-section">
        <div class="form-group mr-auto">
            <label for="showDropdown">Show</label>
            <select class="form-control" id="showDropdown">
                <option>5</option>
                <option>10</option>
                <option>50</option>
                <option>100</option>
            </select>
        </div>

         <!-- Search Filter -->
         <form action="{{ route('company.joblist') }}" method="GET" class="mb-3">
    <div class="row">
        <div class="col-md-4">
            <input type="text" class="form-control" name="job_title" placeholder="Job Title">
        </div>
        <div class="col-md-4">
            <select class="form-select" name="job_category" aria-label="Job Category">
                <option value="" selected>Select Job Category</option>
                <option value="it">Information Technology</option>
                <option value="finance">Finance</option>
                <option value="healthcare">Healthcare</option>
                <option value="marketing">Marketing</option>
                <option value="engineering">Engineering</option>
                <option value="education">education</option>
                <option value="sales">Sales</option>
                <option value="customerService">Customer Service</option>
                <option value="hospitality">Hospitality</option>
                <option value="design">Design</option>
                <option value="writing">Writing/Editing</option>
                <option value="humanResources">Human Resources</option>
                <option value="administration">Administration</option>
                <option value="manufacturing">Manufacturing</option>
                <option value="logistics">Logistics</option>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </div>
</form>

    </div>

    <table id="jobsTable" class="table mt-4">
        <thead>
            <tr>
                <th>#</th>
                <!-- <th>Logo</th> -->
                <th>Job Title</th>
                <th>Job Type</th>
                <th>Job Category</th>
                <th>Location</th>
                <th>Salary</th>
                <th>Deadline</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php
                $serialNumber = 1;
            @endphp

            @forelse($jobs as $job)
                <tr>
                    <td>{{ $serialNumber++ }}</td>
                    <!-- <td>logo</td> -->
                    <td>{{ $job->job_title }}</td>
                    <td>{{ $job->job_type }}</td>
                    <td>{{ $job->job_category }}</td>
                    <td>{{ $job->location }}</td>
                    <td>Rs.{{ number_format($job->salary, 2) }}</td>
                    <td>{{ $job->deadline }}</td>
                    <td>{{ $job->email }}</td>
                    <td>
                @php
                    $currentDate = now();
                    $deadline = \Carbon\Carbon::parse($job->deadline);
                    $status = $deadline->gt($currentDate) ? 'Active' : 'Expired';
                    $badgeColor = $status == 'Active' ? 'badge-primary' : 'badge-secondary';
                @endphp
                <span class="badge {{ $badgeColor }}">{{ $status }}</span>
            </td>
                    <td class="btn-actions">
                        <div class="btn-group" role="group" aria-label="Actions">
                            <button class="btn btn-info btn-sm" onclick="showJobDetails('{{ $job->id }}')">View More</button>
                            <button class="btn btn-warning btn-sm" onclick="showUpdateForm('{{ $job->id }}')">Edit</button>

                            <form action="{{ route('delete.job', ['id' => $job->id]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center">
                        <div class="alert alert-info" role="alert">
                            No results found.
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div id="notification-container">
        @if (session('success'))
            <div class="alertm alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (session('error'))
            <div class="alertm alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    </div>
    <div class="modal fade" id="jobDetailsModal" tabindex="-1" role="dialog" aria-labelledby="jobDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="jobDetailsModalLabel">More Details</h5>
                    <span class="close-button" onclick="closeForm()">X</span>
                </div>
                <div class="modal-body">
                    <!-- Job Details Section -->
                    <div class="box-inside-box text-center mb-3">
                        <h6 class="mb-0">Job Details</h6>
                        <p id="jobDetailsContent"></p>
                    </div>

                    <!-- Requirements Section -->
                    <div class="box-inside-box text-center">
                        <h6 class="mb-0">Requirements</h6>
                        <p id="requirementsContent"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">
        <!-- Previous Page Link -->
        @if ($jobs->onFirstPage())
            <li class="page-item disabled">
                <span class="page-link">&laquo; Previous</span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $jobs->previousPageUrl() }}" rel="prev">&laquo; Previous</a>
            </li>
        @endif

        <!-- Pagination Elements -->
        @for ($i = 1; $i <= $jobs->lastPage(); $i++)
            <li class="page-item{{ ($jobs->currentPage() == $i) ? ' active' : '' }}">
                <a class="page-link" href="{{ $jobs->url($i) }}">{{ $i }}</a>
            </li>
        @endfor

        <!-- Next Page Link -->
        @if ($jobs->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $jobs->nextPageUrl() }}" rel="next">Next &raquo;</a>
            </li>
        @else
            <li class="page-item disabled">
                <span class="page-link">Next &raquo;</span>
            </li>
        @endif
    </ul>
</nav>

</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<!-- Add this script at the end of your HTML body -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script>
    $(document).ready(function () {
        // Set the initial number of rows to show
        var rowsToShow = parseInt($('#showDropdown').val());

        // Function to update the number of displayed rows
        function updateRowsToShow() {
            var jobsRows = $('#jobsTable tbody tr');
            jobsRows.hide();
            jobsRows.slice(0, rowsToShow).show();
        }

        // Initial update based on the default value
        updateRowsToShow();

        // Event listener for the dropdown change
        $('#showDropdown').change(function () {
            rowsToShow = parseInt($(this).val());
            updateRowsToShow();
        });
    });

    $(document).ready(function () {
        setTimeout(function () {
            $('.alertm').alert('close');
        }, 5000);
    });
    
    function showUpdateForm(jobId) {
    // Redirect to the job update form with the job ID
    window.location.href = "{{ url('company/job') }}/" + jobId + "/edit";
}


  function closeForm() {
    window.location.href = "{{ url('/company/job/list') }}";
  }


  function showJobDetails(jobId) {
    // Fetch job details using AJAX or use the available data
    // For simplicity, assume you have the details in the $job variable
    @if(isset($job) && !empty($job))
        var jobDetails = '{{ $job->job_details }}';
        var requirements = '{{ $job->requirements }}';
        
        // Update modal content with job details
        $('#jobDetailsContent').html(jobDetails);
        $('#requirementsContent').html(requirements);

        // Show the modal
        $('#jobDetailsModal').modal('show');
    @else
        // If $job is not defined or is empty, show a no result found message
        $('#jobDetailsContent').html('No result found.');
        $('#requirementsContent').html('No result found.');

        // Show the modal
        $('#jobDetailsModal').modal('show');
    @endif
}

        // Search filter functionality
        $(document).ready(function () {
            $('#search-form').on('submit', function (e) {
                e.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    url: '{{ route('company.joblist') }}',
                    type: 'GET',
                    data: formData,
                    success: function (response) {
                        // Handle the response, update the job list or do whatever is necessary
                    },
                    error: function (error) {
                        console.error('Error:', error.responseText);
                    }
                });
            });
        });
   
</script>



</body>
</html>
