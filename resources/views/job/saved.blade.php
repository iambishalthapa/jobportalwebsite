<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saved Jobs</title>
    <!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Include Bootstrap CSS -->
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
        <!-- Saved Job Cards -->
        <h1>My Save Jobs</h1>
        <div class="row">
            @forelse($jobs as $job)
            <div class="col-md-12 mb-4">
                <div class="card position-relative">
                    <div class="card-body">
                        
                             <!-- Status badge -->
                             @php
        $currentDate = now();
        $deadline = \Carbon\Carbon::parse($job->deadline);
        $isExpired = $deadline->lt($currentDate);
        $status = $isExpired ? 'Expired' : 'Active';
        $badgeColor = $isExpired ? 'badge-expired' : 'badge-active';
    @endphp
                        <span class="badge {{ $badgeColor }} mb-2">{{ $status }}</span>
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
                                <button type="button" class="btn btn-secondary mb-2" data-bs-toggle="modal" data-bs-target="#detailsModal{{ $job->id }}">More Details</button>
                                 <!-- Show Apply Now or Applied button -->
                        <!-- Show Apply Now or Job Expired button -->
        @if($isExpired)
            <button class="btn btn-danger mb-2" disabled>Job Expired</button>
        @else
            @if(!Auth::guard('job_seeker')->check() || !Auth::guard('job_seeker')->user()->hasAppliedJob($job->id))
                <a href="#" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#applyModal{{ $job->id }}">Apply Now</a>
            @else
                <span class="btn btn-success mb-2">Applied</span>
            @endif
        @endif

                        <!-- Add the form for removing the job -->
                        <form action="{{ route('job.remove', ['id' => $job->id]) }}" method="POST" style="display: inline;">
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
            <p>No saved jobs found.</p>
            @endforelse
        </div>
    </div>
<!-- Pagination for $savedJobs -->
<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">
        <!-- Previous Page Link -->
        @if ($savedJobs->onFirstPage())
            <li class="page-item disabled">
                <span class="page-link">&laquo; Previous</span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $savedJobs->previousPageUrl() }}" rel="prev">&laquo; Previous</a>
            </li>
        @endif

        <!-- Pagination Elements -->
        @for ($i = 1; $i <= $savedJobs->lastPage(); $i++)
            <li class="page-item{{ ($savedJobs->currentPage() == $i) ? ' active' : '' }}">
                <a class="page-link" href="{{ $savedJobs->url($i) }}">{{ $i }}</a>
            </li>
        @endfor

        <!-- Next Page Link -->
        @if ($savedJobs->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $savedJobs->nextPageUrl() }}" rel="next">Next &raquo;</a>
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

 
</body>
</html>
