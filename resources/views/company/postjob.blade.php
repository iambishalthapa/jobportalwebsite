<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Post a Job</title>
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
    
    /* Additional styles for step forms */
    .step-form {
      display: none;
    }

    .step-form.active {
      display: block;
    }
  </style>
</head>
<body class="bg-light">
@include('company.navigationbar')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card bg-light text-black position-relative p-4">
          <div class="card-title bg-light">
            <h2>Post a Job</h2>
          </div>
          <div class="card-body">

            <form action="{{ route('company.postjob.store') }}" method="post" id="jobForm">
              @csrf
              <div class="step-form active" id="step1">
              <div class="row">
                <!-- Left Column -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="jobTitle">Job Title:</label>
                    <input type="text" class="form-control" id="jobTitle" name="jobTitle" placeholder="Job Title" required>
                  </div>

                  <div class="form-group">
                    <label for="jobType">Job Type:</label>
                    <select class="form-control" id="jobType" name="jobType" required>
                       <option value="fullTime">Full Time</option>
                      <option value="partTime">Part Time</option>
                      <option value="contract">Contract</option>
                      <option value="internship">Internship</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="jobCategory">Job Category:</label>
                    <select class="form-control" id="jobCategory" name="jobCategory" required>
                      <!-- Add your job categories here -->
                      <option value="">Select Job Category</option>
                        <option value="it">Information Technology</option>
                        <option value="finance">Finance</option>
                        <option value="healthcare">Healthcare</option>
                        <option value="marketing">Marketing</option>
                        <option value="engineering">Engineering</option>
                        <option value="education">Education</option>
                        <option value="sales">Sales</option>
                        <option value="customerService">Customer Service</option>
                        <option value="hospitality">Hospitality</option>
                        <option value="design">Design</option>
                        <option value="writing">Writing/Editing</option>
                        <option value="humanResources">Human Resources</option>
                        <option value="administration">Administration</option>
                        <option value="manufacturing">Manufacturing</option>
                        <option value="logistics">Logistics</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="location">Location:</label>
                    <input type="text" class="form-control" id="location" name="location" placeholder="Location" required>
                  </div>
                </div>

                <!-- Right Column -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="salary">Salary:</label>
                    <input type="number" class="form-control" id="salary" name="salary" placeholder="Salary" required>
                  </div>

                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="pricePerHour">Price per Hour:</label>
                      <input type="number" class="form-control" id="pricePerHour" name="pricePerHour" required>
                    </div>

                    <div class="form-group col-md-6">
                      <label for="deadline">Deadline:</label>
                      <input type="date" class="form-control" id="deadline" name="deadline" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                  </div>

                  <div class="form-group">
                    <label for="phonenumber">Phone Number:</label>
                    <input type="text" class="form-control" id="phonenumber" name="phonenumber" placeholder="Phone Number" required>
                  </div>
                </div>
               </div>
               <div class="form-group text-center">
    <button type="button" class="btn btn-primary" onclick="nextStep('step1', 'step2')">Next</button>
</div>
              </div>
              <div class="step-form" id="step2">
              <div class="form-group">
                <label for="jobDetails">Job Details:</label>
                <textarea class="form-control" id="jobDetails" name="jobDetails" rows="4" required></textarea>
              </div>

              <div class="form-group">
                <label for="requirements">Requirements:</label>
                <textarea class="form-control" id="requirements" name="requirements" rows="4" required></textarea>
              </div>

              <!-- Previous and Submit Buttons -->
              <div class="form-group text-center">
    <button type="button" class="btn btn-secondary" onclick="prevStep('step2', 'step1')">Previous</button>
    <button type="submit" class="btn btn-primary">Post Job</button>
</div>
              </div>
            </form>
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
  </div>
  <script>
   function nextStep(currentStep, nextStep) {
        document.getElementById(currentStep).classList.remove('active');
        document.getElementById(nextStep).classList.add('active');
    }

    function prevStep(currentStep, prevStep) {
        document.getElementById(currentStep).classList.remove('active');
        document.getElementById(prevStep).classList.add('active');
    }
  </script>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  
</body>
</html>
