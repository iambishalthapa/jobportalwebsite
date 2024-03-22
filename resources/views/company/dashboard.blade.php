<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Custom Styles -->
    <style>
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
            margin: 10px ;
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
        .card_wigdet{
            margin-top: 10px !important;
        }
    </style>
</head>
<body>
@include('company.navigationbar')

    <!-- Main Content Section -->
    <section class="main-content">
        <!-- Welcome Message -->
        <!-- Welcome Message -->
    <div class="alert alert-success mt-3">
        <h4 class="alert-heading">Welcome!</h4>
        <p class="mb-0">You are logged in. Welcome to your dashboard, {{ Auth::guard('company')->user()->company_name }}!</p>
    </div>

    <!-- Company Statistics and Help Center -->
    <div class="company-stats-help">
        <!-- Company Statistics -->
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Total Posted Jobs
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $totalPostedJobs }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Total Candidate Applications
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $totalCandidateApplications }}</h5>
                    </div>
                </div>
            </div>
        </div>

        <!-- Help Center Widget -->
        <div class="col-md-12">
            <div class="card widget card_wigdet">
                <div class="widget-header">
                    <h5 class="widget-title">Help Center</h5>
                </div>
                <div class="widget-content">
                    <p>If you need assistance or have any questions, please contact our support team.</p>
                    <button class="btn btn-primary">Contact Support</button>
                </div>
            </div>
        </div>
    </div>
    </section>

  
</body>
</html>
