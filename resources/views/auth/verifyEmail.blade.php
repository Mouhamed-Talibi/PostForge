<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/logo.png') }}" type="image/png">

    <!-- Title -->
    <title>PostForge | Email Verification</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/master.css') }}">
</head>
<body style="background-color: #f8f9fa; min-height: 100vh; display: flex; align-items: center; justify-content: center;">

    <!-- Main content -->
    <div class="text-center bg-white p-5 rounded-4 shadow-lg" style="max-width: 500px; width: 100%;">
        
        <!-- Center Icon -->
        <div class="mb-4">
            <i class="fas fa-envelope-circle-check fa-4x text-primary"></i>
        </div>

        <!-- Title -->
        <h2 class="mb-3">Email <span class="text-primary">Verification</span></h2>

        <!-- Message -->
        <p class="text-secondary mb-2">
            We have sent you a verification link. <br> Please check your email inbox to activate your account.
        </p>

        <!-- Note -->
        <small class="text-danger d-block mb-1">If you don’t see it, check your spam or junk folder.</small>
        <small class="text-muted">PostForge - Email Verification</small>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JS -->
    <script src="{{ asset('js/loader.js') }}"></script>
    <script src="{{ asset('js/offcanvas_close.js') }}"></script>
</body>
</html>
