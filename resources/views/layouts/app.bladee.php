<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Forum Komunitas') - Hasby Forum</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-white border-b sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center gap-3">
                    <h1 class="text-2xl font-bold text-blue-600">🗣️ Forum</h1>
                    <span class="text-gray-400">Komunitas</span>
                </div>

                <div class="flex items-center gap-4">
                    @auth
                        <span class="text-sm text-gray-600">Halo, {{ auth()->user()->name }}</span>
                        
                        <a href="{{ route('posts.create') }}" 
                           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                            + Buat Diskusi
                        </a>

                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-red-500 hover:text-red-600 text-sm font-medium">
                                Keluar
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900">Masuk</a>
                        <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium">Daftar</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-6 py-8">
        @yield('content')
    </main>

    <footer class="bg-white border-t py-6 text-center text-sm text-gray-500">
        Forum Komunitas © {{ date('Y') }} — Muhammad Hasby Abdillah (UTS Web Lanjut)
    </footer>
</body>
</html>