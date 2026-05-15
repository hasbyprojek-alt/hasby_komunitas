@extends('layouts.app')
@section('title', 'Edit Diskusi')

@section('content')
<div class="max-w-2xl mx-auto">

    <div class="mb-6">
        <a href="{{ route('posts.show', $post) }}"
           class="inline-flex items-center gap-1.5 text-sm text-slate-500 hover:text-blue-600 font-medium transition-colors mb-4">
            ← Kembali ke Diskusi
        </a>
        <h1 class="text-2xl font-extrabold text-slate-800">✏️ Edit Diskusi</h1>
        <p class="text-slate-500 mt-1 text-sm">Perbarui isi diskusimu.</p>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8">

        @if($errors->any())
        <div class="bg-red-50 border border-red-200 rounded-xl p-4 mb-6">
            <p class="text-sm font-semibold text-red-700 mb-2">Ada kesalahan:</p>
            <ul class="list-disc list-inside text-sm text-red-600 space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('posts.update', $post) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Judul -->
            <div class="mb-5">
                <label class="block text-sm font-semibold text-slate-700 mb-2" for="title">
                    Judul Diskusi <span class="text-red-500">*</span>
                </label>
                <input type="text" id="title" name="title"
                       value="{{ old('title', $post->title) }}"
                       class="w-full border {{ $errors->has('title') ? 'border-red-400 bg-red-50' : 'border-slate-200' }}
                              rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                @error('title')
                <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Kategori -->
            <div class="mb-5">
                <label class="block text-sm font-semibold text-slate-700 mb-2" for="category">
                    Kategori <span class="text-red-500">*</span>
                </label>
                <select id="category" name="category"
                        class="w-full border {{ $errors->has('category') ? 'border-red-400 bg-red-50' : 'border-slate-200' }}
                               rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                    @foreach(['Teknologi', 'Pendidikan', 'Kesehatan', 'Lingkungan', 'Budaya', 'Lainnya'] as $cat)
                    <option value="{{ $cat }}" {{ old('category', $post->category) === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
                @error('category')
                <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Isi -->
            <div class="mb-7">
                <label class="block text-sm font-semibold text-slate-700 mb-2" for="content">
                    Isi Diskusi <span class="text-red-500">*</span>
                </label>
                <textarea id="content" name="content" rows="8"
                          class="w-full border {{ $errors->has('content') ? 'border-red-400 bg-red-50' : 'border-slate-200' }}
                                 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all resize-none">{{ old('content', $post->content) }}</textarea>
                @error('content')
                <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-3">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-7 py-3 rounded-xl transition-colors text-sm shadow-sm">
                    ✅ Simpan Perubahan
                </button>
                <a href="{{ route('posts.show', $post) }}"
                   class="text-sm text-slate-500 hover:text-slate-700 font-medium transition-colors px-4 py-3 rounded-xl border border-slate-200 hover:bg-slate-50">
                    Batal
                </a>
            </div>
        </form>
    </div>

</div>
@endsection
