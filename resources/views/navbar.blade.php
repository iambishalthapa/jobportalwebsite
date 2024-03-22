<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Your Jobs Website</title>
  <style>
    /* Custom styles can be added here */
    .navbar-brand {
      font-size: 24px;
    }
    .navbar-dark .navbar-nav .nav-link {
      color: white;
    }
    .navbar-dark .navbar-toggler-icon {
      background-color: white;
    }
    .navbar-toggler {
      border-color: white;
    }
    .navbar-toggler:focus,
    .navbar-toggler:active {
      outline: none;
    }
    .register-dropdown {
      margin-right: 20px; /* Adjust margin for better spacing */
    }
    .navbar-brand {
            font-size: 30px; /* Adjust the font size as needed */
            font-weight: bold;
        }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-xl navbar-light bg-light">
<img src="photos/logo.png" width="80" height="80" alt="Your Logo">
  <a class="navbar-brand" href="#">Jobs Website</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto">
    <li class="nav-item active">
        <a class="nav-link mr-2" href="{{ url('/') }}">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link mr-2" href="#">About Us</a>
      </li>
      <li class="nav-item">
        <a class="nav-link mr-2  " href="#">Contact Us</a>
      </li>
      @auth
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/dashboard') }}">Dashboard</a>
            </li>
        @else
      <li class="nav-item">
        <a class="btn btn-primary mr-2 btn-dark" href="{{ route('login') }}">Login</a>
      </li>
      @if (Route::has('register'))
      <li class="nav-item dropdown register-dropdown">
        <div class="btn-group">
          <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Register
          </button>
          <div class="dropdown-menu mt-3 dropdown-menu-right">
            <a class="dropdown-item" href="{{route('jobsregister')}}">Register for Job Seeker</a>
            <a class="dropdown-item" href="{{route('companyregister')}}">Register for Company</a>
          </div>
        </div>
      </li>
      @endif
        @endauth
    </ul>
  </div>
</nav>

<!-- Bootstrap JS and Popper.js Script Links -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
