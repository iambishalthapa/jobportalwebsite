
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Seeker Dashboard</title>
    <!-- Bootstrap CSS CDN link -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Additional custom styles can be added here */
        .welcome-message {
            text-align: center;
            margin-bottom: 20px;
        }
        .dashboard-stats {
            margin-top: 20px;
        }
        .dashboard-stat {
            text-align: center;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .container{
            margin-left: 195px !important;
        }
        body {
            background-color: #f8f9fa;
        }

        .navbar {
            background-color: #343a40;
        }

        .navbar-brand,
        .navbar-text {
            color: #ffffff;
        }
        
        .profile-image-container {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }

        .profile-image-container img {
            border-radius: 50%;
            border: 2px solid #fff;
            object-fit: cover;
            width: 90px;
            height: 90px;
        }


        .main-content {
            margin-top 20px;
            padding: 15px;
    max-width: 1200px; /* Adjusted max-width */
    margin-left: 270px; /* Adjusted margin-left to accommodate the sidebar */
    margin-right: auto;
        }

        .widget {
            margin-bottom: 20px;
        }

        .widget-header {
            background-color: #343a40;
            color: #ffffff;
            padding: 10px;
        }

        .widget-title {
            margin: 0;
        }

        .widget-content {
            padding: 15px;
        }

        .list-group-item {
            border-color: #dee2e6;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>
<body>
@include('job.jobnavigationbar')

<div class="container">
<div class="alert alert-success mt-3">
            <h4 class="alert-heading">Welcome!</h4>
            <p class="mb-0">You are logged in. Welcome to your dashboard,   {{ Auth::guard('job_seeker')->user()->full_name }}!</p>
        </div>

    <div class="dashboard-stats">
        <div class="row">
            <div class="col-md-4">
                <div class="dashboard-stat">
                    <h3>Total Applied Jobs</h3>
                    <p>{{ $totalAppliedJobs }}</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="dashboard-stat">
                    <h3>Total Saved Jobs</h3>
                    <p>{{ $totalSavedJobs }}</p>
                </div>
            </div>
            <!-- Add more statistics here as needed -->
        </div>
    </div>
<!-- Help Center Widget -->
<div class="col-md-12">
                <div class="card widget">
                    <div class="widget-header">
                        <h5 class="widget-title">Help Center</h5>
                    </div>
                    <div class="widget-content">
                        <p>If you need assistance or have any questions, please contact our support team.</p>
                        <button class="btn btn-primary">Contact Support</button>
                    </div>
                </div>
            </div>
    <!-- You can add more sections or content here -->

</div>

<!-- Bootstrap JS CDN link -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
