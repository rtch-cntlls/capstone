<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>500</title>
</head>
<body>
    <div class="container text-center mt-5">
        <img src="{{ asset('storage/images/500.gif')}}" alt="500" width="300">
        <p class="lead">Something went wrong. Please try again later.</p>
        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary mt-3">Go Back</a>
    </div>
</body>
</html>