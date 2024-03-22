<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS CDN link -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container{
            margin-top: 30px !important;
            margin-left:195px !important;
        }
        /* Additional custom styles can be added here */
        .welcome-message {
            text-align: center;
            margin-bottom: 20px;
        }
        .dashboard-stat {
            text-align: center;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
@include('admin.adminnav')

<div class="container">
<div class="alert alert-success mt-3">
            <h4 class="alert-heading">Welcome!</h4>
            <p class="mb-0">You are logged in. Welcome to your dashboard, {{ Auth::user()->name }}!</p>
        </div>

    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="dashboard-stat">
                <h3>Total Companies</h3>
                <p>{{ $totalCompanies }}</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="dashboard-stat">
                <h3>Total Job Seekers</h3>
                <p>{{ $totalJobSeekers }}</p>
            </div>
        </div>
    </div>

    <!-- You can add more statistics or content here -->

</div>

<!-- Bootstrap JS CDN link -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
