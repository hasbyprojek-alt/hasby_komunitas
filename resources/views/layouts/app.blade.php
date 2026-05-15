<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Forum Komunitas') — HasbyForum</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50:  '#eff6ff',
                            100: '#dbeafe',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-slate-50 min-h-screen flex flex-col">

    <!-- Navbar -->
    <nav class="bg-white border-b border-slate-200 sticky top-0 z-50 shadow-sm">
        <div class="max-w-6xl mx-auto px-4 sm:px-6">
            <div class="flex justify-between items-center h-16">

                <!-- Logo -->
                <a href="{{ route('posts.index') }}" class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold text-sm">H</span>
                    </div>
                    <span class="text-lg font-bold text-slate-800">HasbyForum</span>
                    <span class="hidden sm:block text-xs text-slate-400 font-normal">Komunitas Diskusi</span>
                </a>

                <!-- Nav Actions -->
                <div class="flex items-center gap-3">
                    @auth
                        <span class="hidden sm:block text-sm text-slate-500">
                            Halo, <strong class="text-slate-700">{{ auth()->user()->name }}</strong>
                        </span>

                        <a href="{{ route('posts.create') }}"
                           class="inline-flex items-center gap-1.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-4 py-2 rounded-lg transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Buat Diskusi
                        </a>

                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit"
                                class="text-sm text-slate-500 hover:text-red-500 font-medium transition-colors px-2 py-2">
                                Keluar
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                           class="text-sm text-slate-600 hover:text-blue-600 font-medium transition-colors">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}"
                           class="text-sm bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg transition-colors">
                            Daftar
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('success'))
    <div class="max-w-6xl mx-auto px-4 sm:px-6 pt-4">
        <div class="flex items-center gap-3 bg-green-50 border border-green-200 text-green-700 px-5 py-3 rounded-xl text-sm font-medium">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            {{ session('success') }}
        </div>
    </div>
    @endif

    <!-- Content -->
    <main class="flex-1 max-w-6xl mx-auto w-full px-4 sm:px-6 py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-slate-200 py-5 mt-auto">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 flex flex-col sm:flex-row justify-between items-center gap-2 text-xs text-slate-400">
            <span>HasbyForum © {{ date('Y') }} — Aplikasi Forum Komunitas</span>
            <span>Muhammad Hasby Abdillah | Sistem Informasi — UMP</span>
        </div>
    </footer>

</body>
</html>
