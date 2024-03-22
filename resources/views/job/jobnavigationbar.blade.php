<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Your Dashboard</title>
<!-- Bootstrap CSS -->
<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>




<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.18.0/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            padding-top: 56px;
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }

        .navbar-dark .navbar-toggler-icon {
            background-color: #28a745; /* Green color for the toggle button */
        }

        .navbar-toggler {
            border-color: #28a745; /* Green color for the toggle button border */
        }

        .navbar-nav .nav-item {
            transition: background-color 0.3s, color 0.3s;
        }

        .navbar-nav .nav-item:hover {
            background-color: #28a745; /* Green color on hover */
            color: #fff; /* White text on hover */
        }

        .navbar-sidebar {
            background-color: #333;
            height: 100vh;
            position: fixed;
            top: 76px;
            left: 0;
            width: 195px;
            padding-top: 1rem;
            padding-bottom: 1rem;
            z-index: 1;
        }

        .navbar-sidebar .nav-link {
            color: #fff;
            padding: 1rem;
            transition: color 0.3s;
            display: block;
            width: 100%;
            text-align: left;
        }

        .navbar-sidebar .nav-item:hover .nav-link  {
            color: #ffc107; /* Yellow color on hover */
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
            margin-left: 250px;
            padding: 15px;
        }

        .search-bar {
            width: 250px;
            margin-left: auto;
        }

        .navbar-sidebar .bi {
            color: #fff;
        }

        .notification-icon, .message-icon {
            color: #fff !important;
        }

        .dashboard-icon, .job-search-icon, .applied-jobs-icon, .saved-jobs-icon, .messages-icon, .help-center-icon {
            color: #17a2b8; /* Blue color for icon elements */
        }
    </style>
</head>
<body>


<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <!-- <img src="" alt="Company Logo"> -->
            <a class="navbar-brand" href="#" style="color: #fff;">Jobs Website</a>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="input-group search-bar">
            <input type="text" class="form-control" placeholder="Search" aria-label="Search"
                aria-describedby="searchIcon">
            <button class="btn btn-outline-light" type="button" id="searchIcon">
                Search
            </button>
        </div>

        <div class="ms-auto">
            <span class="navbar-text me-3">
                <i class="bi bi-bell notification-icon"></i>
            </span>
            <span class="navbar-text">
                <i class="bi bi-envelope message-icon"></i>
            </span>
        </div>

        <div class="navbar-text ms-3">
            <div class="dropdown">
                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="profileDropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #fff;">
                    {{ Auth::guard('job_seeker')->user()->full_name }}
                </a>
                <div class="dropdown-menu" aria-labelledby="profileDropdown">
                <a class="dropdown-item" href="{{ route('job_seeker.update-account', ['id' => Auth::guard('job_seeker')->id()]) }}" style="color: #333;">Account</a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item" style="color: #333;">Log Out</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>

<nav class="navbar-sidebar">
    <!-- Sidebar navigation for job seeker -->
    <!-- Include profile image, navigation links, and help center icon -->

    <div class="profile-image-container">
      <img src="{{ asset('jobphotos/' . basename(Auth::guard('job_seeker')->user()->profile_picture)) }}" alt="Profile" class="rounded-circle custom-circle" height="80">

    </div>
    <ul class="navbar-nav flex-column">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('job.dashboard') }}" style="color: #fff;">
                <i class="bi bi-speedometer2 dashboard-icon"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('job.search') }}" style="color: #fff;">
                <i class="bi bi-search job-search-icon"></i> Job Search
            </a>
        </li>
        <li class="nav-item">
            
        <li class="nav-item">
    <a class="nav-link" href="{{ route('job.saved', Auth::guard('job_seeker')->user()->id) }}" style="color: #fff;">
        <i class="bi bi-heart applied-jobs-icon"></i> Saved Jobs
    </a>
</li>
       
<li class="nav-item">
    <a class="nav-link" href="{{ route('job.appliedjobs') }}" style="color: #fff;">
        <i class="bi bi-heart applied-jobs-icon"></i> Applied Jobs
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('jobseeker.messages') }}" style="color: #fff;">
        <i class="bi bi-heart applied-jobs-icon"></i> Messages
    </a>
</li>
        <li class="nav-item">
        <a class="nav-link" href="{{ route('job-help-center') }}" style="color: #fff;">
        <i class="bi bi-question-circle help-center-icon"></i> Job Help Center
    </a>
        </li>
    </ul>

   
</nav>

<section class="main-content">

</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>

</body>
</html>
