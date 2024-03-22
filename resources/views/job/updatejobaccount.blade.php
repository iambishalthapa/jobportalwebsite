<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <style>
     body {
  background-color: #f8f9fa;
}

.border-box {
  border: 1px solid #e2e2e2;
  padding: 20px;
  margin: 0px 151px 0px;
  border-radius: 10px;
  background-color: #fff;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.container {
  margin-right: 34px !important;
  margin-top: 29px;
}

.file-upload-btn {
  cursor: pointer;
  color: #fff;
  background-color: #28a745;
  border: 1px solid #28a745;
  padding: 10px;
  border-radius: 5px;
  display: inline-block;
}

.file-upload-btn:hover {
  background-color: #218838;
}

.tab-content {
  margin-top: 20px;
}

.form-group label {
  font-weight: bold;
}

.btn-update {
  display: block;
  width: 100%;
  padding: 10px;
  margin-top: 20px;
  color: #fff;
  background-color: #007bff;
  border: 1px solid #007bff;
  border-radius: 5px;
  font-size: 16px;
}

/* Additional styling for input and form controls */
.form-control {
  margin-bottom: 15px;
  padding: 10px;
  border-radius: 5px;
}

/* Adjustments for form labels */
.form-group label {
  display: block;
  margin-bottom: 5px;
}
.custom-container {
        max-width: 1200px; /* Adjust this value based on your design */
        margin: 0 auto; /* Center the container */
     }

  </style>
  <title>Job Seeker Account Update</title>
</head>
<body>
@include('job.jobnavigationbar')
<div class="custom-container mt-5">
  <div class="row">
  <form action="{{ route('job_seeker.update-account', ['id' => $jobSeeker->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="border-box">
          <h4 class="text-center mb-4">Edit Profile</h4>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="uploadProfilePicture">Upload Profile Picture</label>
                <input type="file" name="uploadProfilePicture" id="uploadProfilePicture">
              </div>

              <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter new password">
              </div>
              <div class="form-group">
                <label for="confirmPassword">Confirm Password:</label>
                <input type="password" class="form-control" id="confirmPassword" name="confirm_password" placeholder="Confirm new password">
              </div>
              <div class="form-group">
                <label for="email">Email Address:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="{{ $jobSeeker->email }}">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="contactNumber">Contact Number:</label>
                <input type="tel" class="form-control" id="contactNumber" name="contactNumber" placeholder="Enter contact number" value="{{ $jobSeeker->contact_number }}">
              </div>
              <div class="form-group">
                <label for="fullName">Full Name:</label>
                <input type="text" class="form-control" id="fullName" name="fullName" placeholder="Enter full name" value="{{ $jobSeeker->full_name }}">
              </div>
              <div class="form-group">
                <label for="jobPreference">Job Preference:</label>
                <input type="text" class="form-control" id="jobPreference" name="jobPreference" placeholder="Enter job preference" value="{{ $jobSeeker->job_preference }}">
              </div>
              <div class="form-group">
                <label for="gender">Gender:</label>
                <select class="form-control" id="gender" name="gender">
                  <option value="Male" {{ $jobSeeker->gender === 'Male' ? 'selected' : '' }}>Male</option>
                  <option value="Female" {{ $jobSeeker->gender === 'Female' ? 'selected' : '' }}>Female</option>
                  <!-- Add more options as needed -->
                </select>
              </div>
            </div>
          </div>

          <button type="submit" class="btn btn-update mt-4 mx-auto d-block">Update Account</button>
        </div>
      </form>
    </div>
  </div>
<!-- Bootstrap and jQuery scripts -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
