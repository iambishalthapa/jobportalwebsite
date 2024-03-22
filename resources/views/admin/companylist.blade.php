<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <style>
        .container{
            margin-left:195px !important;
            margin-top:30px !important;
        }
    </style>
    
@include('admin.adminnav')
<div class="container">
    <h1>Company List</h1>
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
    <table class="table">
        <thead>
            <tr>
                <th scope="col">S.N.</th>
                <th scope="col">Company Name</th>
                <th scope="col">Email</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @php
                $serialNumber = 1;
            @endphp
            @foreach($companies as $company)
                <tr>
                    <td>{{ $serialNumber++ }}</td>
                    <td>{{ $company->company_name }}</td>
                    <td>{{ $company->email }}</td>
                    <td>
                        <form action="{{ route('admin.deleteCompany', ['id' => $company->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
