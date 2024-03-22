<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Company Registration</title>
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
<div class="container mt-2">
  <div class="row justify-content-center">
    <div class="col-md-8">

      <div class="card bg-light text-black position-relative">
      <span class="close-button" onclick="closeForm()">X</span>
        <div class="card-title bg-light">
          <h5>Company Registration</h5>
        </div>
        <div class="card-body">

          <form method="POST" action="{{ route('companyregister') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-row">

              <!-- Company Logo -->
              <div class="form-group col-md-6">
                <label for="uploadCompanyLogo">Company Logo:</label>
                <input type="file" class="form-control-file" id="uploadCompanyLogo" name="uploadCompanyLogo" accept="image/*" onchange="previewCompanyLogo()">
              </div>

              <!-- Email Address -->
              <div class="form-group col-md-6">
                <label for="email">Email Address:</label>
                <input type="email" class="form-control" id="email" name="email" value="" required>
                @if ($errors->has('email'))
                  <div class="mt-2">
                    @foreach($errors->get('email') as $error)
                      <span class="text-danger">{{ $error }}</span><br>
                    @endforeach
                  </div>
                @endif
              </div>

              <!-- Primary Phone Number -->
              <div class="form-group col-md-6">
                <label for="primaryPhoneNumber">Primary Phone Number:</label>
                <input type="tel" class="form-control" id="primaryPhoneNumber" name="primaryPhoneNumber" required>
                @if ($errors->has('primaryPhoneNumber'))
                  <div class="mt-2">
                    @foreach($errors->get('primaryPhoneNumber') as $error)
                      <span class="text-danger">{{ $error }}</span><br>
                    @endforeach
                  </div>
                @endif
              </div>

              <!-- Company Name -->
              <div class="form-group col-md-6">
                <label for="companyName">Company Name:</label>
                <input type="text" class="form-control" id="companyName" name="companyName" required>
                @if ($errors->has('companyName'))
                  <div class="mt-2">
                    @foreach($errors->get('companyName') as $error)
                      <span class="text-danger">{{ $error }}</span><br>
                    @endforeach
                  </div>
                @endif
              </div>

              <!-- Choose Company Industry -->
              <div class="form-group col-md-6">
                <label for="companyIndustry">Choose Company Industry:</label>
                <select class="form-control" id="companyIndustry" name="companyIndustry" required>
                  <option value="" disabled selected>Select Company Industry</option>
                  <option value="it">Information Technology</option>
                  <option value="manufacturing">Manufacturing</option>
                  <option value="finance">Finance</option>
                  <!-- Add more industries as needed -->
                </select>
                @if ($errors->has('companyIndustry'))
                  <div class="mt-2">
                    @foreach($errors->get('companyIndustry') as $error)
                      <span class="text-danger">{{ $error }}</span><br>
                    @endforeach
                  </div>
                @endif
              </div>

              <!-- City -->
              <div class="form-group col-md-6">
                <label for="city">City:</label>
                <input type="text" class="form-control" id="city" name="city" required>
                @if ($errors->has('city'))
                  <div class="mt-2">
                    @foreach($errors->get('city') as $error)
                      <span class="text-danger">{{ $error }}</span><br>
                    @endforeach
                  </div>
                @endif
              </div>

              <!-- Location -->
              <div class="form-group col-md-6">
                <label for="location">Location:</label>
                <input type="text" class="form-control" id="location" name="location" required>
                @if ($errors->has('location'))
                  <div class="mt-2">
                    @foreach($errors->get('location') as $error)
                      <span class="text-danger">{{ $error }}</span><br>
                    @endforeach
                  </div>
                @endif
              </div>

              <!-- Contact Person Name -->
              <div class="form-group col-md-6">
                <label for="contactPersonName">Contact Person Name:</label>
                <input type="text" class="form-control" id="contactPersonName" name="contactPersonName" required>
                @if ($errors->has('contactPersonName'))
                  <div class="mt-2">
                    @foreach($errors->get('contactPersonName') as $error)
                      <span class="text-danger">{{ $error }}</span><br>
                    @endforeach
                  </div>
                @endif
              </div>

              <!-- Mobile (Contact Person) -->
              <div class="form-group col-md-6">
                <label for="contactPersonMobile">Contact Person Mobile:</label>
                <input type="tel" class="form-control" id="contactPersonMobile" name="contactPersonMobile" required>
                @if ($errors->has('contactPersonMobile'))
                  <div class="mt-2">
                    @foreach($errors->get('contactPersonMobile') as $error)
                      <span class="text-danger">{{ $error }}</span><br>
                    @endforeach
                  </div>
                @endif
              </div>

              <!-- Contact Person Email -->
              <div class="form-group col-md-6">
                <label for="contactPersonEmail">Contact Person Email:</label>
                <input type="email" class="form-control" id="contactPersonEmail" name="contactPersonEmail" required>
                @if ($errors->has('contactPersonEmail'))
                  <div class="mt-2">
                    @foreach($errors->get('contactPersonEmail') as $error)
                      <span class="text-danger">{{ $error }}</span><br>
                    @endforeach
                  </div>
                @endif
              </div>
              
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
              <span class="text-center">
            Already have an account? <a href="{{route('login') }}" style="color: #007bff;">Login here</a>.
          </span>

            </div>

            <!-- Submit Button -->
            <div class="form-group text-center mt-4">
              <button type="submit" class="btn btn-primary">Register Company</button>
            </div>

          </form>


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
