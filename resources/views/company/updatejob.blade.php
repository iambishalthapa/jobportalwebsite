<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Job</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <style>
    body {
      background-color: #f8f9fa;
    }

    .card {
      border: none;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card-title {
      font-size: 28px;
      font-weight: bold;
      margin-bottom: 20px;
      text-align: center;
      color: #007bff;
    }

    label {
      font-weight: bold;
      color: #495057;
    }

    .form-check-label {
      font-weight: normal;
    }

    .form-group {
      margin-bottom: 20px;
    }

    textarea {
      resize: vertical;
    }

    .btn-primary {
      background-color: #007bff;
      border: none;
    }

    .btn-primary:hover {
      background-color: #0056b3;
    }

    .container {
      margin-top: 50px;
    }
    .close-button {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
        }
  </style>
</head>
<body class="bg-light">
@include('company.navigationbar')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card bg-light text-black position-relative p-4">
        <span class="close-button" onclick="closeForm()">X</span>
          <div class="card-title bg-light">
            <h2>Update Job</h2>
          </div>
          <div class="card-body">

            <form action="{{ route('company.updatejob', ['id' => $job->id]) }}" method="post">
              @csrf
              @method('PUT')

              <div class="row">
                <!-- Left Column -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="jobTitle">Job Title:</label>
                    <input type="text" class="form-control" id="jobTitle" name="jobTitle" value="{{ $job->job_title }}" required>
                  </div>

                  <div class="form-group">
                    <label for="jobType">Job Type:</label>
                    <select class="form-control" id="jobType" name="jobType" required>
                      <option value="fullTime" {{ $job->job_type === 'fullTime' ? 'selected' : '' }}>Full Time</option>
                      <option value="partTime" {{ $job->job_type === 'partTime' ? 'selected' : '' }}>Part Time</option>
                      <option value="contract" {{ $job->job_type === 'contract' ? 'selected' : '' }}>Contract</option>
                      <option value="internship" {{ $job->job_type === 'internship' ? 'selected' : '' }}>Internship</option>
                    </select>
                  </div>

                  <div class="form-group">
    <label for="jobCategory">Job Category:</label>
    <select class="form-control" id="jobCategory" name="jobCategory" required>
        <!-- Add your job categories here -->
        <option value="">Select Job Category</option>
        <option value="it" {{ $job->job_category === 'it' ? 'selected' : '' }}>Information Technology</option>
        <option value="finance" {{ $job->job_category === 'finance' ? 'selected' : '' }}>Finance</option>
        <option value="healthcare" {{ $job->job_category === 'healthcare' ? 'selected' : '' }}>Healthcare</option>
        <option value="marketing" {{ $job->job_category === 'marketing' ? 'selected' : '' }}>Marketing</option>
        <option value="engineering" {{ $job->job_category === 'engineering' ? 'selected' : '' }}>Engineering</option>
        <option value="education" {{ $job->job_category === 'education' ? 'selected' : '' }}>Education</option>
        <option value="sales" {{ $job->job_category === 'sales' ? 'selected' : '' }}>Sales</option>
        <option value="customerService" {{ $job->job_category === 'customerService' ? 'selected' : '' }}>Customer Service</option>
        <option value="hospitality" {{ $job->job_category === 'hospitality' ? 'selected' : '' }}>Hospitality</option>
        <option value="design" {{ $job->job_category === 'design' ? 'selected' : '' }}>Design</option>
        <option value="writing" {{ $job->job_category === 'writing' ? 'selected' : '' }}>Writing/Editing</option>
        <option value="humanResources" {{ $job->job_category === 'humanResources' ? 'selected' : '' }}>Human Resources</option>
        <option value="administration" {{ $job->job_category === 'administration' ? 'selected' : '' }}>Administration</option>
        <option value="manufacturing" {{ $job->job_category === 'manufacturing' ? 'selected' : '' }}>Manufacturing</option>
        <option value="logistics" {{ $job->job_category === 'logistics' ? 'selected' : '' }}>Logistics</option>
    </select>
</div>


                  <div class="form-group">
                    <label for="location">Location:</label>
                    <input type="text" class="form-control" id="location" name="location" value="{{ $job->location }}" required>
                  </div>
                </div>

                <!-- Right Column -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="salary">Salary:</label>
                    <input type="number" class="form-control" id="salary" name="salary" value="{{ $job->salary }}" required>
                  </div>

                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="pricePerHour">Price per Hour:</label>
                      <input type="number" class="form-control" id="pricePerHour" name="pricePerHour" value="{{ $job->price_per_hour }}" required>
                    </div>

                    <div class="form-group col-md-6">
                      <label for="deadline">Deadline:</label>
                      <input type="date" class="form-control" id="deadline" name="deadline" value="{{ $job->deadline }}" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $job->email }}" required>
                  </div>

                  <div class="form-group">
                    <label for="phonenumber">Phone Number:</label>
                    <input type="text" class="form-control" id="phonenumber" name="phonenumber" value="{{ $job->phone_number }}" required>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for="jobDetails">Job Details:</label>
                <textarea class="form-control" id="jobDetails" name="jobDetails" rows="4" required>{{ $job->job_details }}</textarea>
              </div>

              <div class="form-group">
                <label for="requirements">Requirements:</label>
                <textarea class="form-control" id="requirements" name="requirements" rows="4" required>{{ $job->requirements }}</textarea>
              </div>

              <!-- Submit Button -->
              <div class="form-group text-center">
                <button type="submit" class="btn btn-primary">Update Job</button>
              </div>
            </form>

          </div>
          @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> 
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
        </div>
      </div>
    </div>
  </div>
<script>
      function closeForm() {
    window.location.href = "{{ url('/company/job/list') }}";
  }
    </script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  
</body>
</html>
