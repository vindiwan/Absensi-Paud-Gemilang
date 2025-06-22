<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login - PAUD Gemilang</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-white min-h-screen flex items-center justify-center font-sans">

    <div class="w-full max-w-md bg-white rounded-lg shadow-lg p-8 text-center">
        <!-- Judul Login -->
        <div class="mb-6">
            <h2 class="text-3xl font-bold text-indigo-500">Login</h2>
            <p class="text-xl font-semibold text-indigo-500 mt-1">PAUD Gemilang</p>
        </div>

        <!-- Form Login -->
        <form action="{{ route('login') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label for="username" class="block text-gray-700 font-semibold mb-2 text-left">Username</label>
                <input type="text" id="username" name="username" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    placeholder="Masukkan username" />
            </div>

            <div>
                <label for="password" class="block text-gray-700 font-semibold mb-2 text-left">Password</label>
                <input type="password" id="password" name="password" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    placeholder="Masukkan password" />
            </div>

            <button type="submit"
                class="w-full bg-indigo-500 text-white font-semibold py-3 rounded-md hover:bg-indigo-600 transition">
                Masuk
            </button>
        </form>

        @if ($errors->any())
        <div class="mt-4 text-red-500 text-sm">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>

</body>

</html>