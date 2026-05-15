@extends('layouts.app')
@php use Illuminate\Support\Str; @endphp
@section('title', 'Forum Diskusi')

@section('content')

<!-- Header -->
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
    <div>
        <h1 class="text-2xl font-extrabold text-slate-800">Forum Diskusi Komunitas 🗣️</h1>
        <p class="text-slate-500 mt-1 text-sm">Berbagi ide, pengalaman, dan solusi bersama.</p>
    </div>
    @auth
    <a href="{{ route('posts.create') }}"
       class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition-colors shadow-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Buat Diskusi Baru
    </a>
    @endauth
</div>

<!-- Search & Filter -->
<form method="GET" class="flex flex-col sm:flex-row gap-3 mb-8">
    <div class="relative flex-1">
        <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
        </svg>
        <input type="text" name="search" value="{{ request('search') }}"
               placeholder="Cari judul diskusi..."
               class="w-full pl-10 pr-4 py-2.5 border border-slate-200 rounded-xl text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
    </div>

    <select name="category"
            class="border border-slate-200 rounded-xl px-4 py-2.5 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        <option value="">Semua Kategori</option>
        @foreach(['Teknologi','Pendidikan','Kesehatan','Lingkungan','Budaya','Lainnya'] as $cat)
            <option value="{{ $cat }}" {{ request('category') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
        @endforeach
    </select>

    <button type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-6 py-2.5 rounded-xl transition-colors">
        Cari
    </button>

    @if(request('search') || request('category'))
    <a href="{{ route('posts.index') }}"
       class="text-sm text-slate-500 hover:text-slate-700 font-medium px-4 py-2.5 rounded-xl border border-slate-200 bg-white transition-colors text-center">
        Reset
    </a>
    @endif
</form>

<!-- Posts List -->
@forelse($posts as $post)
@php
$catColors = [
    'Teknologi'  => 'bg-blue-100 text-blue-700',
    'Pendidikan' => 'bg-yellow-100 text-yellow-700',
    'Kesehatan'  => 'bg-red-100 text-red-700',
    'Lingkungan' => 'bg-green-100 text-green-700',
    'Budaya'     => 'bg-purple-100 text-purple-700',
    'Lainnya'    => 'bg-slate-100 text-slate-600',
];
$cc = $catColors[$post->category] ?? 'bg-slate-100 text-slate-600';
@endphp
<div class="bg-white rounded-2xl border border-slate-200 p-6 mb-4 hover:shadow-md hover:border-blue-200 transition-all group">
    <div class="flex items-start justify-between gap-4">
        <div class="flex-1 min-w-0">
            <!-- Category Badge -->
            <span class="inline-block text-xs font-semibold px-3 py-1 rounded-full {{ $cc }} mb-3">
                {{ $post->category }}
            </span>

            <!-- Title -->
            <a href="{{ route('posts.show', $post) }}"
               class="block text-lg font-bold text-slate-800 hover:text-blue-600 transition-colors group-hover:text-blue-600 leading-snug">
                {{ $post->title }}
            </a>

            <!-- Preview -->
            <p class="text-slate-500 text-sm mt-2 leading-relaxed">
                {{ Str::limit($post->content, 150) }}
            </p>
        </div>

        <!-- Like count -->
        <div class="shrink-0 flex items-center gap-1 text-slate-400 text-sm">
            <svg class="w-4 h-4 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
            </svg>
            {{ $post->likes }}
        </div>
    </div>

    <!-- Footer Meta -->
    <div class="flex items-center justify-between mt-5 pt-4 border-t border-slate-100">
        <div class="flex items-center gap-3">
            <div class="w-7 h-7 bg-blue-100 rounded-full flex items-center justify-center text-blue-700 font-bold text-xs">
                {{ strtoupper(substr($post->user->name ?? 'U', 0, 1)) }}
            </div>
            <span class="text-sm text-slate-600 font-medium">{{ $post->user->name ?? 'Pengguna' }}</span>
            <span class="text-slate-300">•</span>
            <span class="text-xs text-slate-400">{{ $post->created_at->diffForHumans() }}</span>
        </div>

        @if(auth()->id() === $post->user_id)
        <div class="flex items-center gap-2">
            <a href="{{ route('posts.edit', $post) }}"
               class="text-xs font-semibold text-amber-600 hover:text-amber-700 px-3 py-1.5 rounded-lg hover:bg-amber-50 transition-colors">
                ✏️ Edit
            </a>
            <form method="POST" action="{{ route('posts.destroy', $post) }}"
                  onsubmit="return confirm('Yakin ingin menghapus diskusi ini?')">
                @csrf @method('DELETE')
                <button type="submit"
                        class="text-xs font-semibold text-red-500 hover:text-red-600 px-3 py-1.5 rounded-lg hover:bg-red-50 transition-colors">
                    🗑️ Hapus
                </button>
            </form>
        </div>
        @else
        <a href="{{ route('posts.show', $post) }}"
           class="text-xs text-blue-600 font-semibold hover:underline">
            Baca Selengkapnya →
        </a>
        @endif
    </div>
</div>
@empty
<div class="text-center py-20">
    <div class="text-5xl mb-4">💬</div>
    <p class="text-slate-500 text-lg font-medium">Belum ada diskusi.</p>
    <p class="text-slate-400 text-sm mt-1">Jadilah yang pertama memulai!</p>
    @auth
    <a href="{{ route('posts.create') }}"
       class="inline-block mt-5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-6 py-2.5 rounded-xl transition-colors">
        + Buat Diskusi
    </a>
    @endauth
</div>
@endforelse

<!-- Pagination -->
<div class="mt-6">
    {{ $posts->links() }}
</div>

@endsection
