<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Search</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.18.0/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .mt-5 {
            margin-left: 198px !important;
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
        .badge-active {
        background-color: #28a745; /* Green color for Active */
        color: white; /* Text color */
    }

    .badge-expired {
        background-color: #dc3545; /* Red color for Expired */
        color: white; /* Text color */
    }
    </style>
</head>

<body>
    @include('job.jobnavigationbar')

    <div class="container mt-5">
        <!-- Search Filter -->
        <form action="{{ route('job.search') }}" method="GET" class="mb-3">
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
        @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<!-- Add this div to your HTML to display error messages -->
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

        <!-- Job Cards -->
        <div class="row">
            @forelse($jobs as $job)
            <div class="col-md-12 mb-4">
                <div class="card position-relative">
                    <div class="card-body">
                    @php
                $currentDate = now();
                $deadline = \Carbon\Carbon::parse($job->deadline);
                $status = $deadline->gt($currentDate) ? 'Active' : 'Expired';
                $badgeColor = $status == 'Active' ? 'badge-primary' : 'badge-secondary';
                @endphp
               
<!-- Update the badge span in your job card to use the custom classes -->
<span class="badge {{ $status == 'Active' ? 'badge-active' : 'badge-expired' }}">{{ $status }}</span>
                       <!-- Heart Icon -->
                       <button type="button" class="btn btn-link position-absolute top-0 end-0 love-icon" data-job-id="{{ $job->id }}">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
        <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.920 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
    </svg>
</button>


                        <!-- Company Logo -->
                        <img src="{{ asset('companyphotos/' . basename($job->company->logo)) }}" class="card-img-top mb-3" alt="Company Logo" style="width: 50px; height: 50px;">

                        <!-- Job Details -->
                        <div class="row">
                            <div class="col-md-3">
                                <p><strong>Company:</strong> {{ $job->company->company_name }}</p>
                            </div>
                            <div class="col-md-2">
                                <p><strong>Job Type:</strong> {{ $job->job_type }}</p>
                            </div>
                            <div class="col-md-2">
                                <p><strong>Deadline:</strong> {{ $job->deadline }}</p>
                            </div>
                            <div class="col-md-2">
                                <p><strong>Location:</strong> {{ $job->location }}</p>
                            </div>
                            <div class="col-md-2">
                                <p><strong>Salary:</strong> Rs.{{ $job->salary }}</p>
                            </div>
                            
                        </div>

                        <div class="row justify-content-end">
    <div class="col-md-6 text-end">
        @if(Auth::guard('job_seeker')->check() && Auth::guard('job_seeker')->user()->hasAppliedJob($job->id))
            <button type="button" class="btn btn-secondary mb-2" data-bs-toggle="modal" data-bs-target="#detailsModal{{ $job->id }}">More Details</button>    
            <span class="btn btn-secondary mb-2">Applied</span>
        @elseif($status == 'Expired')
            <span class="btn btn-secondary mb-2">Job Expired</span>
        @else
            <button type="button" class="btn btn-secondary mb-2" data-bs-toggle="modal" data-bs-target="#detailsModal{{ $job->id }}">More Details</button>
            <a href="#" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#applyModal{{ $job->id }}">Apply Now</a>
        @endif
    </div>
</div>

                    </div>
                    
                </div>
            </div>
            <!-- Modal for More Details -->
            <div class="modal fade" id="detailsModal{{ $job->id }}" tabindex="-1" aria-labelledby="detailsModalLabel{{ $job->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="detailsModalLabel{{ $job->id }}">Job Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <p><strong>Company:</strong> {{ $job->company->company_name }}</p>
                            <p><strong>Job Details:</strong> {{ $job->job_details }}</p>
                            <p><strong>Requirements:</strong> {{ $job->requirements }}</p>
                            <p><strong>Price Per Hour:</strong> {{ $job->price_per_hour }}</p>
                            <p><strong>Email:</strong> {{ $job->email }}</p>
                            <p><strong>Phone Number:</strong> {{ $job->phone_number }}</p>
                            <!-- Add more details as needed -->
                        </div>
                       
                    </div>
                </div>
            </div>
            <div class="modal fade" id="applyModal{{ $job->id }}" tabindex="-1" aria-labelledby="applyModalLabel{{ $job->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="applyModalLabel{{ $job->id }}">Apply for {{ $job->job_title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form for applying to the job -->
                <form action="{{ route('job.apply', ['jobId' => $job->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Resume input -->
                    <div class="mb-3">
                        <label for="resume" class="form-label">Resume (PDF, DOC, DOCX)</label>
                        <input type="file" class="form-control" id="resume" name="resume" accept=".pdf, .doc, .docx" required>
                    </div>

                    <!-- Cover Letter input -->
                    <div class="mb-3">
                        <label for="coverLetter" class="form-label">Cover Letter</label>
                        <input type="file" class="form-control" id="coverLetter" name="cover_letter" rows="4" required>
                    </div>

                    <!-- Message input (optional) -->
                    <div class="mb-3">
                        <label for="message" class="form-label">Message (Optional)</label>
                        <textarea class="form-control" id="message" name="message" rows="4"></textarea>
                    </div>

                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary">Apply Now</button>

                </form>
                <!-- Add this div to your HTML to display success messages -->
            </div>
         </div>
        </div>
         </div>
            @empty
            <p>No jobs found.</p>
            @endforelse
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
   
    <script>
        $(document).ready(function () {
            // Saved jobs functionality
            var savedJobIds = {!! json_encode(Auth::guard('job_seeker')->check() ? Auth::guard('job_seeker')->user()->savedJobs->pluck('job_id') : []) !!};
            
            savedJobIds.forEach(function (jobId) {
                $('.love-icon[data-job-id="' + jobId + '"]').css('color', 'red');
            });
            
            $(document).on('click', '.love-icon', function () {
                var loveIcon = $(this);
                var jobId = loveIcon.data('job-id');
            
                if (savedJobIds.includes(jobId)) {
                    return;
                }
            
                $.ajax({
                    url: '{{ route('job.save') }}',
                    type: 'POST',
                    data: {
                        job_id: jobId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        loveIcon.css('color', 'red');
                        savedJobIds.push(jobId);
                    },
                    error: function (error) {
                        console.error('Error:', error.responseText);
                    }
                });
            });
        });
    </script>

    <script>
        // Search filter functionality
        $(document).ready(function () {
            $('#search-form').on('submit', function (e) {
                e.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    url: '{{ route('job.search') }}',
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


    <!-- Include Bootstrap JS script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
