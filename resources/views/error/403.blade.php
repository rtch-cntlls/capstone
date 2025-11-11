<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>403</title>
</head>
<body class="bg-black text-white">
    <div class="text-center mt-5">
        <img src="{{ asset('images/403.gif')}}" alt="403" width="500">
        <p class="lead">Access Denied. You do not have permission to access this page.</p>
        <a href="{{ url()->previous() }}" class="btn btn-danger">Go back</a>
    </div>
</body>
</html>