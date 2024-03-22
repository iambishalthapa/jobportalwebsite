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
  margin: 10px;
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

  </style>
  <title>Account Update</title>
</head>
<body>
@include('company.navigationbar')
<div class="container mt-5">
  <div class="row">
    <form action="{{ route('company.update', ['id' => auth('company')->user()->id]) }}" method="post" enctype="multipart/form-data" class="col-md-8 mx-auto">
      @csrf
      @method('PUT')

      <div class="border-box">
        <h4 class="text-center mb-4">Edit Profile</h4>

        <ul class="nav nav-tabs nav-fill mb-4" id="myTabs">
          <li class="nav-item">
            <a class="nav-link active" id="userInfoTab" data-toggle="tab" href="#userInfo">User Info</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="companyDetailsTab" data-toggle="tab" href="#companyDetails">Company Details</a>
          </li>
        </ul>

        <div class="tab-content">
          <div class="tab-pane fade show active" id="userInfo">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="uploadCompanyLogo">Upload Company Logo</label>
                  <input type="file" name="uploadCompanyLogo" id="uploadCompanyLogo">
                </div>

                <div class="form-group">
                  <label for="password">Password:</label>
                  <input type="password" class="form-control" id="password" name="password" value="{{ str_repeat('*', 10) }}" readonly>
                </div>
                <div class="form-group">
                  <label for="confirmPassword">Confirm Password:</label>
                  <input type="password" class="form-control" id="confirmPassword" name="confirm_password" value="{{ str_repeat('*', 10) }}" readonly>
                </div>
                <div class="form-group">
                  <label for="email">Email Address:</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="{{ $company->email }}">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="primaryPhoneNumber">Primary Phone Number:</label>
                  <input type="tel" class="form-control" id="primaryphonenumber" name="primaryphonenumber" placeholder="Enter phone number" value="{{ $company->primary_phone_number}}">
                </div>
              </div>
            </div>
          </div>

          <div class="tab-pane fade" id="companyDetails">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="contactPersonName">Contact Person Name:</label>
                  <input type="text" class="form-control" id="contactpersonname" name="contactpersonname" placeholder="Enter contact person name" value="{{ $company->contact_person_name}}">
                </div>
                <div class="form-group">
                  <label for="contactPersonNumber">Contact Person Number:</label>
                  <input type="tel" class="form-control" id="contactpersonnumber" name="contactpersonnumber" placeholder="Enter contact person number" value="{{ $company->contact_person_mobile}}">
                </div>
                <div class="form-group">
                  <label for="contactPersonEmail">Contact Person Email:</label>
                  <input type="email" class="form-control" id="contactpersonemail" name="contactpersonemail" placeholder="Enter contact person email" value="{{ $company->contact_person_email}}">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="companyName">Company Name:</label>
                  <input type="text" class="form-control" id="companyname" name="companyname" placeholder="Enter company name" value="{{ $company->company_name}}">
                </div>
                <div class="form-group">
                  <label for="companyIndustry">Company Industry:</label>
                  <input type="text" class="form-control" id="companyindustry" name="companyindustry" placeholder="Enter company industry" value="{{ $company->company_industry }}">
                </div>
                <div class="form-group">
                  <label for="city">City:</label>
                  <input type="text" class="form-control" id="city" name="city" placeholder="Enter city" value="{{ $company->city}}">
                </div>
                <div class="form-group">
                  <label for="location">Location:</label>
                  <input type="text" class="form-control" id="location" name="location" placeholder="Enter location" value="{{ $company->location}}">
                </div>
              </div>
            </div>
          </div>
               
          <button type="submit" class="btn btn-update mt-4 mx-auto d-block">Update Account</button>
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

<!-- Bootstrap and jQuery scripts -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>