<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candidate List</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<style>
   .container{
    margin-left: 195px !important;
   }
</style>
</head>

<body>
    @include('company.navigationbar')
    <div class="container mt-5">
        <h2 class="mb-4">Candidate List</h2>
        @if ($applications->isEmpty())
        <div class="alert alert-info" role="alert">
            No candidates available.
        </div>
        @else
        <div class="row">
            @foreach($applications as $application)
            <div class="col-md-4 mb-4">
                <div class="card shadow">
                    <div class="card-body text-center">
                        <h5 class="mb-4">Applied For - {{ $application->job->job_title }}</h5>
                        <div class="mb-4">
                            <img src="{{ asset('jobphotos/' . basename($application->jobSeeker->profile_picture)) }}"
                                alt="Profile Picture" class="img-fluid rounded-circle" style="max-width: 100px;">
                        </div>
                        <div class="mb-3">
                            <strong>Name:</strong> {{ $application->jobSeeker->full_name }}
                        </div>
                        <div class="mb-3">
                            <strong>Email:</strong> {{ $application->jobSeeker->email }}
                        </div>
                        <div class="mb-4">
                            <a href="{{ asset($application->resume_path) }}" class="btn btn-primary btn-sm"
                                target="_blank">View CV</a>
                        </div>
                        <div class="mb-4">
                            <a href="{{ asset($application->cover_letter_path) }}" class="btn btn-info btn-sm"
                                target="_blank">View Cover Letter</a>
                        </div>
                        <div class="mb-4">
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#messageModal{{$application->id}}">
                                Send Message
                            </button>
                        </div>
                        <div class="mb-3">
                            <strong>Status:</strong>
                            @if($application->status == 'accepted')
                            <span class="badge badge-success">Accepted</span>
                            @elseif($application->status == 'rejected')
                            <span class="badge badge-danger">Rejected</span>
                            @else
                            <span class="badge badge-warning">Pending</span>
                            @endif
                        </div>
                        <div class="d-flex justify-content-center">
                            <form method="POST"
                                action="{{ route('job.acceptApplication', ['id' => $application->id]) }}"
                                class="mr-2">
                                @csrf
                                <button type="submit" class="btn btn-success">Accept</button>
                            </form>
                            <form method="POST"
                                action="{{ route('job.rejectApplication', ['id' => $application->id]) }}">
                                @csrf
                                <button type="submit" class="btn btn-danger">Reject</button>
                            </form>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="messageModal{{$application->id}}" tabindex="-1" role="dialog"
                        aria-labelledby="messageModalLabel{{$application->id}}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="messageModalLabel{{$application->id}}">Send Message</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('send.message') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="application_id" value="{{ $application->id }}">
                                        <div class="form-group">
                                            <label for="message">Message:</label>
                                            <textarea class="form-control" name="message" id="message"
                                                rows="3" required></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Send Message</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>

    <!-- Bootstrap JS and dependencies (optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
