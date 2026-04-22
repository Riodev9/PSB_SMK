<!-- resources/views/partials/head.blade.php -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PSB SMK Obi')</title>

    <!-- Tailwind CSS via Vite -->
    @vite('resources/css/app.css')
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Alpine.js untuk modal, dropdown, collapse -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Optional: custom JS -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
