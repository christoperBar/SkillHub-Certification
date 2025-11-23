<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkillHub – @yield('title')</title>

    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-800 font-sans">

    <header class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <div class="w-9 h-9 bg-blue-600 rounded-lg flex items-center justify-center text-white font-bold text-xl">
                    S
                </div>
                <h1 class="text-2xl font-bold text-gray-800">SkillHub</h1>
            </div>

            <nav class="flex gap-6 text-gray-600">
                <a href="{{ url('/') }}" class="hover:text-blue-600 transition">Home</a>
                <a href="{{ route('participants.index') }}" class="hover:text-blue-600 transition">Partisipan</a>
                <a href="{{ route('kelas.index') }}" class="hover:text-blue-600 transition">Kelas</a>
                <a href="{{ route(name: 'instructors.index') }}" class="hover:text-blue-600 transition">Instruktur</a>
                <a href="{{ route(name: 'registrations.index') }}" class="hover:text-blue-600 transition">Registrasi</a>
            </nav>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-6 py-6">
        @yield('content')
    </main>

</body>
</html>
