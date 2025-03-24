<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Boesman App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        .video-bg {
            position: fixed;
            top: 0;
            left: 0;
            min-width: 100%;
            min-height: 100%;
            object-fit: cover;
            z-index: -1;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 0;
        }

        .content {
            position: relative;
            z-index: 1;
        }
    </style>
</head>
<body>
    <!-- Background Video -->
    <video autoplay muted loop class="video-bg">
        <source src="{{ asset('videos/cloud.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <!-- Optional dark overlay to increase text visibility -->
    <div class="overlay"></div>

    <!-- Main Content -->
    <div class="container mt-5 content">
        @if(session('success'))
            <div class="alert alert-success text-center fade show">
                {{ session('success') }}
            </div>
         @endif

        @if($errors->any())
            <div class="alert alert-danger text-center fade show">
                {{ $errors->first() }}
            </div>
        @endif

        @yield('content')
</div>

<script>
    // Sembunyikan alert setelah 5 detik
    setTimeout(() => {
        const alert = document.querySelector('.alert');
        if (alert) {
            alert.classList.add('fade');
            setTimeout(() => alert.remove(), 500);
        }
    }, 500);
</script>
</body>
</html>
