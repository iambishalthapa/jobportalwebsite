<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Your Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.18.0/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            padding-top: 56px;
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4; /* Light gray background */
            color: #333; /* Dark text color */
        }

        .navbar-dark .navbar-toggler-icon {
            background-color: #007bff; /* Blue color for the toggle button */
        }

        .navbar-toggler {
            border-color: #007bff; /* Blue color for the toggle button border */
        }

        .navbar-nav .nav-item {
            transition: background-color 0.3s, color 0.3s;
        }

        .navbar-nav .nav-item:hover {
            background-color: #007bff; /* Blue color on hover */
            color: #fff; /* White text on hover */
        }

        .navbar-sidebar {
            background-color: #333; /* Dark background color */
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
            color: #fff; /* White text color */
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

        

        .search-bar {
            width: 250px;
            margin-left: auto;
        }

        .navbar-sidebar .bi {
            color: #fff; /* White color for icons */
        }

        .notification-icon, .message-icon {
            color: #fff !important; /* White color for notification and message icons */
        }

        .dashboard-icon, .post-job-icon, .activity-icon, .messages-icon, .candidates-icon, .help-center-icon {
            color: #007bff; /* Blue color for icon elements */
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
        <!-- <img src="photos/logo.png" width="80" height="80" alt="Your Logo"> -->
  <a class="navbar-brand" href="#">Jobs Website</a>
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
        {{ Auth::user()->name }}
    </a>
    <div class="dropdown-menu" aria-labelledby="profileDropdown">

    <a class="dropdown-item" href="{{ route('admin.editProfile') }}" style="color: #333;">Account</a>

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
   
    <ul class="navbar-nav flex-column">
    <li class="nav-item">
    <a class="nav-link" href="{{ route('dashboard') }}" style="color: #fff;">
                <i class="bi bi-envelope candidates-icon"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.companyList') }}" style="color: #fff;">
                <i class="bi bi-envelope candidates-icon"></i> Company List
            </a>
        </li>
    </ul>

    <ul class="navbar-nav flex-column mt-auto">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.jobseekers') }} "style="color: #fff;">
                <i class="bi bi-headset help-center-icon"></i> Job Seeker List
            </a>
        </li>
        
    </ul>
</nav>

<section class="main-content">
    <!-- Your main content goes here -->
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
