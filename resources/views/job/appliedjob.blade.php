
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Add your head content here -->
    <title>Applied Jobs</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Add your other styles or scripts here -->
    <!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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

        /* Watermark styles */
        .watermark {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .watermark-text {
            font-size: 24px;
            font-weight: bold;
            color: rgba(0, 0, 0, 0.5); /* Adjust opacity as needed */
        }
    </style>
</head>

<body>

    @include('job.jobnavigationbar') <!-- Assuming you have a navigation bar -->

    <div class="container mt-5">
        <!-- Applied Job Cards -->
        <h1>My Applied Jobs</h1>
        







        <div class="row">
            @forelse($applications as $application)
            <div class="col-md-12 mb-4">
                <div class="card position-relative">
                    <div class="card-body">
                       <!-- Watermark for Accepted or Rejected status -->
                       @if($application->status == 'accepted')
            <div class="badge bg-success watermark-text position-absolute" style="top: 10px; left: 10px;">Accepted</div>
        @elseif($application->status == 'rejected')
            <div class="badge bg-danger watermark-text position-absolute" style="top: 10px; left: 10px;">Rejected</div>
        @endif


                        <!-- Company Logo -->
                        <img src="{{ asset('companyphotos/' . basename($application->company->logo)) }}" class="card-img-top mb-3" alt="Company Logo" style="width: 50px; height: 50px;">

                        <!-- Application Details -->
                        <div class="row">
                            <div class="col-md-3">
                                <p><strong>Company:</strong> {{ $application->company->company_name }}</p>
                            </div>
                            <div class="col-md-2">
                                <p><strong>Job Title:</strong> {{ $application->job->job_title }}</p>
                            </div>
                            <div class="col-md-2">
                                <p><strong>Applied On:</strong> {{ $application->created_at->format('Y-m-d') }}</p>
                            </div>
                            <div class="col-md-2">
                                <p><strong>Salary:</strong> Rs.{{ $application->job->salary }}</p>
                            </div>
                            <div class="col-md-2">
                                <p><strong>Location:</strong> {{ $application->job->location }}</p>
                            </div>
                            <!-- Add more details as needed -->
                        </div>

                        <div class="row justify-content-end">
                            <div class="col-md-6 text-end">
                                <button type="button" class="btn btn-secondary mb-2" data-bs-toggle="modal" data-bs-target="#detailsModal{{ $application->id }}">More Details</button>
                                 <!-- Add a form for removing the applied job -->
    <form action="{{ route('job.removeApplied', ['id' => $application->id]) }}" method="post" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger mb-2">Remove</button>
    </form>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <!-- Modal for More Details -->
            <div class="modal fade" id="detailsModal{{ $application->id }}" tabindex="-1" aria-labelledby="detailsModalLabel{{ $application->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailsModalLabel{{ $application->id }}">Job Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Company:</strong> {{ $application->company->company_name }}</p>
                <p><strong>Job Details:</strong> {{ $application->job->job_details }}</p>
                <p><strong>Requirements:</strong> {{ $application->job->requirements }}</p>
                <p><strong>Price Per Hour:</strong> {{ $application->job->price_per_hour }}</p>
                <p><strong>Email:</strong> {{ $application->job->email}}</p>
                <p><strong>Phone Number:</strong> {{ $application->job->phone_number  }}</p>
                <!-- Add more details as needed -->
            </div>
        </div>
    </div>
</div>
            @empty
            <p>No applied jobs found.</p>
            @endforelse
        </div>
    </div>
    <nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">
        <!-- Previous Page Link -->
        @if ($applications->onFirstPage())
            <li class="page-item disabled">
                <span class="page-link">&laquo; Previous</span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $applications->previousPageUrl() }}" rel="prev">&laquo; Previous</a>
            </li>
        @endif

        <!-- Pagination Elements -->
        @for ($i = 1; $i <= $applications->lastPage(); $i++)
            <li class="page-item{{ ($applications->currentPage() == $i) ? ' active' : '' }}">
                <a class="page-link" href="{{ $applications->url($i) }}">{{ $i }}</a>
            </li>
        @endfor

        <!-- Next Page Link -->
        @if ($applications->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $applications->nextPageUrl() }}" rel="next">Next &raquo;</a>
            </li>
        @else
            <li class="page-item disabled">
                <span class="page-link">Next &raquo;</span>
            </li>
        @endif
    </ul>
</nav>

    <!-- Include Bootstrap JS script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Add your additional scripts here -->

</body>
</html>