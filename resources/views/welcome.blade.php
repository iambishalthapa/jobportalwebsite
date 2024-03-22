<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            margin: 0 !important;
            padding: 0 !important;
            background: url('{{ asset('photos/homethumbails.jpg') }}');
            background-size: cover;
            background-repeat: no-repeat;
        }

        .container {
            margin-top: 200px;
            font-family: 'Arial Black', sans-serif;
            font-size: 100px;
            font-weight: 900;
            margin-bottom: 78px;
            color: #28395a;
            line-height: 1.2;
        }

        /* Add more styles for other sections as needed */

        .search-form {
            display: flex;
            align-items: center;
            margin-top: 20px;
        }

        .search-form input[type="text"], .search-form button {
            height: 50px;
            font-size: 16px;
            margin: 0 2px;
        }
    </style>
</head>
<body>
    @include('navbar')

    <!-- Your content goes here -->
    <div class="container">
        <h1>Find the</h1>
        <h1>most exciting</h1>
        <h1>start-up Jobs</h1>

        <!-- Search form -->
        <div class="search-form">
            <input type="text" placeholder="Job Title" style="width: 300px;">
            <input type="text" placeholder="Location" style="width: 300px;">
            <button type="button" class="btn btn-primary">Search</button>
        </div>
    </div>


</body>
</html>
