<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Job Seeker Registration</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <style>
    body {
            background-color: #f8f9fa;
        }

        .card {
            border: 1px solid #dcdcdc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .card-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
        }

        label {
            font-weight: bold;
        }

        .form-check-label {
            font-weight: normal;
        }
        
        .close-button {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
        }

    </style>
</head>
<body class="bg-light text-black">
@include('navbar')
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-8">

      <div class="card bg-light text-black position-relative">
      <span class="close-button" onclick="closeForm()">X</span>
      <div class="card-title bg-light">
      <h5>Job Seeker Registration</h5>
        </div>
        <div class="card-body">

          <form method="POST" action="{{ route('jobsregister') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-row">

              <!-- Profile Picture -->
              <div class="form-group col-md-6">
                <label for="uploadProfilePicture">Profile Picture:</label>
                <input type="file" class="form-control-file" id="uploadProfilePicture" name="uploadProfilePicture" accept="image/*" onchange="previewProfilePicture()">
              </div>

              <!-- Email Address -->
              <div class="form-group col-md-6">
                <label for="email">Email Address:</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                @if ($errors->has('email'))
                  <div class="mt-2">
                    @foreach($errors->get('email') as $error)
                      <span class="text-danger">{{ $error }}</span><br>
                    @endforeach
                  </div>
                @endif
              </div>

              <!-- Contact Number -->
              <div class="form-group col-md-6">
                <label for="contactNumber">Contact Number:</label>
                <input type="tel" class="form-control" id="contactNumber" name="contactNumber" required>
                @if ($errors->has('contactNumber'))
                  <div class="mt-2">
                    @foreach($errors->get('contactNumber') as $error)
                      <span class="text-danger">{{ $error }}</span><br>
                    @endforeach
                  </div>
                @endif
              </div>

              <!-- Full Name -->
              <div class="form-group col-md-6">
                <label for="fullName">Full Name:</label>
                <input type="text" class="form-control" id="fullName" name="fullName" required>
                @if ($errors->has('fullName'))
                  <div class="mt-2">
                    @foreach($errors->get('fullName') as $error)
                      <span class="text-danger">{{ $error }}</span><br>
                    @endforeach
                  </div>
                @endif
              </div>

              <!-- Job Preference -->
              <div class="form-group col-md-6">
                <label for="jobPreference">Job Preference:</label>
                <select class="form-control" id="jobPreference" name="jobPreference" required>
                  <option value="" disabled selected>Select Job Preference</option>
                  <option value="software">Software Development</option>
                  <option value="design">Graphic Design</option>
                  <option value="marketing">Digital Marketing</option>
                  <!-- Add more job preferences as needed -->
                </select>
                @if ($errors->has('jobPreference'))
                  <div class="mt-2">
                    @foreach($errors->get('jobPreference') as $error)
                      <span class="text-danger">{{ $error }}</span><br>
                    @endforeach
                  </div>
                @endif
              </div>

              <!-- Gender -->
              <div class="form-group col-md-6">
                <label for="gender">Gender:</label>
                <select class="form-control" id="gender" name="gender" required>
                  <option value="" disabled selected>Select Gender</option>
                  <option value="male">Male</option>
                  <option value="female">Female</option>
                  <option value="other">Other</option>
                </select>
                @if ($errors->has('gender'))
                  <div class="mt-2">
                    @foreach($errors->get('gender') as $error)
                      <span class="text-danger">{{ $error }}</span><br>
                    @endforeach
                  </div>
                @endif
              </div>

              <!-- Password -->
          <!-- Password -->
          <div class="form-group col-md-6">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
                @if ($errors->has('password'))
                  <div class="mt-2">
                    @foreach($errors->get('password') as $error)
                      <span class="text-danger">{{ $error }}</span><br>
                    @endforeach
                  </div>
                @endif
              </div>


              <!-- Retype Password -->
              <div class="form-group col-md-6">
    <label for="confirmPassword">Re-Type Password:</label>
    <input type="password" class="form-control" id="confirmPassword" name="password_confirmation" required>
    @if ($errors->has('confirmPassword'))
        <div class="mt-2">
            @foreach($errors->get('confirmPassword') as $error)
                <span class="text-danger">{{ $error }}</span><br>
            @endforeach
        </div>
    @endif
</div>

            </div>

            <!-- Submit Button -->
            <div class="form-group text-center mt-4">
              <button type="submit" class="btn btn-primary">Create Account</button>
            </div>

          </form>

          <div class="text-center mt-3">
            Already have an account? <a href="#" style="color: #007bff;">Login here</a>.
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
<script>
  function closeForm() {
    window.location.href = "{{ url('/') }}";
  }
</script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
