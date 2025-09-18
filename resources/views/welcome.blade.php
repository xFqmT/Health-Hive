<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Health Hive</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" />
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
</head>
<body class="flex items-center justify-center h-screen">
    <div class="flex flex-col md:flex-row items-center justify-center w-auto h-auto md:ml-8">
        <!-- Picture -->
        <div class="pic flex items-center justify-center w-auto md:w-1/2 h-auto">
            <img src="{{ asset('images/health_hive.jpg') }}" alt="health_hive" class="w-auto h-auto object-cover">
        </div>

        <!-- Text Container -->
        <div class="text-center w-full md:w-1/2 h-full flex flex-col items-center justify-center">
            <!-- Title -->
            <h1 class="title text-gray-600 mt-2">HEALTH HIVE</h1>

            <!-- Title Desc -->
            <p class="desc text-gray-600">WEBSITE PENDATAAN SISWA</p>
            <p class="place text-gray-600 mt-1">UKS SMKN 1 KOTA BENGKULU</p>

            <!-- Button -->
            <a href="{{ route('dashboard') }}" class="mt-6 inline-block bg-cyan-500 text-white py-1 px-5 rounded-lg hover:bg-blue-300 transition duration-300 text-xl">MULAI</a>
        </div>
    </div>
</body>
</html>