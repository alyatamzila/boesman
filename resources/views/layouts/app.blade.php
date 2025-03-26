<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FIDS Oesman Airport App</title>
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

        .logo-kiri {
            position: fixed;
            top: -50;
            left: 0;
            height: 250px;
            margin: 0;
            z-index: 30;
            padding: 0;
        }

        .logo-kanan {
            position: fixed;
            top: -50;
            right: 0;
            height: 250px;
            margin: 0;
            z-index: 10;
            padding: 0;
        }
        .custom-alert {
            transition: opacity 0.5s ease, transform 0.5s ease;
        }
        .custom-alert.hide {
            opacity: 0;
            transform: translateY(-10px);
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
    <div class="container mt-5 content position-relative">

        {{-- Logo Kiri dan Kanan di atas card --}}
        <div class="d-flex justify-content-between align-items-center mb-3 px-3">
            <img src="{{ asset('images/70.png') }}" alt="Logo Kiri" class="logo-kiri">
            <img src="{{ asset('images/71.png') }}" alt="Logo Kanan" class="logo-kanan">
        </div>

        {{-- Alert message --}}
        @if(session('success'))
            <div class="alert alert-success custom-alert text-center mt-3 mx-5">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger custom-alert text-center mt-3 mx-5">
                {{ $errors->first() }}
            </div>
        @endif



        {{-- Konten dinamis --}}
        @yield('content')
    </div>
</div>

<script>
    setTimeout(() => {
        const alerts = document.querySelectorAll('.custom-alert');
        alerts.forEach(alert => {
            alert.classList.add('hide');
            setTimeout(() => alert.remove(), 500); // tunggu animasi selesai
        });
    }, 500);
</script>


</body>
</html>
