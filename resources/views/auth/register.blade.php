<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar — HasbyForum</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center p-4">

<div class="w-full max-w-md">

    <div class="text-center mb-8">
        <div class="w-14 h-14 bg-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
            <span class="text-white font-black text-2xl">H</span>
        </div>
        <h1 class="text-2xl font-extrabold text-slate-800">Buat Akun Baru</h1>
        <p class="text-slate-500 text-sm mt-1">Gratis, cepat, dan mudah</p>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8">

        @if($errors->any())
        <div class="bg-red-50 border border-red-200 rounded-xl p-4 mb-6 text-sm text-red-600">
            @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
            @endforeach
        </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-5">
                <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}" required autofocus
                       placeholder="Nama kamu..."
                       class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
            </div>

            <div class="mb-5">
                <label class="block text-sm font-semibold text-slate-700 mb-2">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                       placeholder="email@example.com"
                       class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
            </div>

            <div class="mb-5">
                <label class="block text-sm font-semibold text-slate-700 mb-2">Password</label>
                <input type="password" name="password" required
                       placeholder="Min. 8 karakter"
                       class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
            </div>

            <div class="mb-7">
                <label class="block text-sm font-semibold text-slate-700 mb-2">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required
                       placeholder="Ulangi password..."
                       class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
            </div>

            <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl transition-colors text-sm shadow-sm">
                Daftar Sekarang
            </button>
        </form>

        <p class="text-center text-sm text-slate-500 mt-6">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-700 font-semibold">Masuk di sini</a>
        </p>
    </div>
</div>

</body>
</html>
