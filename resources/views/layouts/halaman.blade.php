<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://unpkg.com/lucide@latest"></script>
    @include('partials.head')
</head>

<body class="bg-gradient-to-b from-gray-200 via-gray-300 to-gray-500 min-h-screen p-6">
    <div x-data="{ open: true }">
        <!-- Sidebar -->
        @include('partials.sidebar')

        <!-- Main Content -->
        <main
            :class="open ? 'ml-64' : 'ml-16'"
            class="transition-all duration-300 min-h-screen p-6"
        >
            @yield('content')
        </main>
    </div>
</body>
</html>
