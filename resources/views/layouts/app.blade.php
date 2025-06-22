<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PAUD Gemilang')</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
    tailwind.config = {
        darkMode: 'class'
    }
    </script>

    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
    .material-symbols-rounded {
        font-variation-settings: 'FILL'0, 'wght'400, 'GRAD'0, 'opsz'24;
    }
    </style>
</head>

<body class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-white transition-colors duration-500">
    <div class="flex h-screen">
        <!-- Sidebar -->
        @include('components.sidebar')

        <!-- Main Content -->
        <main class="flex-1 p-6 overflow-y-auto">
            @yield('content')
        </main>
    </div>

    <!-- Dark Mode Script -->
    <script>
    const html = document.documentElement;
    if (localStorage.getItem("theme") === "dark") {
        html.classList.add("dark");
    }

    function setDarkMode() {
        html.classList.add("dark");
        localStorage.setItem("theme", "dark");
    }

    function setLightMode() {
        html.classList.remove("dark");
        localStorage.setItem("theme", "light");
    }

    window.addEventListener('DOMContentLoaded', () => {
        const dateInput = document.getElementById('dateInput');
        const today = new Date();
        const day = String(today.getDate()).padStart(2, '0');
        const month = String(today.getMonth() + 1).padStart(2, '0');
        const year = today.getFullYear();
        if (dateInput) {
            dateInput.value = `${day}/${month}/${year}`;
        }
    });
    </script>
</body>

</html>