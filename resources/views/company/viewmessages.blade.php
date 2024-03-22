<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        <h2>Job Applicant Messages</h2>

        @if($applications->isEmpty())
            <p>No messages available</p>
        @else
            @foreach($applications as $application)
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <h5 class="mb-4">Applicant Details for - {{ $application->job->job_title }}</h5>

                        <div class="mb-3">
                            <strong>Name:</strong> {{ $application->jobSeeker->full_name }}
                        </div>

                        <div class="mb-3">
                            <strong>Email:</strong> {{ $application->jobSeeker->email }}
                        </div>

                        <div class="mb-3">
                            <strong>Message:</strong> {{ $application->message ?? 'No message provided' }}
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    <!-- Bootstrap core JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
