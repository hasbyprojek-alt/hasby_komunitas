@extends('layouts.app')
@section('title', $post->title)

@section('content')
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

<div class="max-w-3xl mx-auto">

    <!-- Back -->
    <a href="{{ route('posts.index') }}"
       class="inline-flex items-center gap-1.5 text-sm text-slate-500 hover:text-blue-600 font-medium transition-colors mb-6">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Kembali ke Forum
    </a>

    <!-- Article Card -->
    <article class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-8">

            <!-- Category & Date -->
            <div class="flex flex-wrap items-center gap-3 mb-4">
                <span class="text-xs font-semibold px-3 py-1 rounded-full {{ $cc }}">
                    {{ $post->category }}
                </span>
                <span class="text-xs text-slate-400">{{ $post->created_at->format('d M Y, H:i') }}</span>
                @if($post->updated_at != $post->created_at)
                <span class="text-xs text-slate-400 italic">(diperbarui {{ $post->updated_at->diffForHumans() }})</span>
                @endif
            </div>

            <!-- Title -->
            <h1 class="text-2xl md:text-3xl font-extrabold text-slate-900 leading-tight mb-6">
                {{ $post->title }}
            </h1>

            <!-- Author -->
            <div class="flex items-center gap-3 pb-6 border-b border-slate-100 mb-6">
                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-700 font-bold text-sm">
                    {{ strtoupper(substr($post->user->name ?? 'U', 0, 1)) }}
                </div>
                <div>
                    <p class="font-semibold text-slate-800 text-sm">{{ $post->user->name ?? 'Pengguna' }}</p>
                    <p class="text-xs text-slate-400">Penulis Diskusi</p>
                </div>
            </div>

            <!-- Content -->
            <div class="text-slate-700 leading-relaxed text-base whitespace-pre-line">
                {{ $post->content }}
            </div>
        </div>

        <!-- Actions Footer -->
        <div class="bg-slate-50 px-8 py-4 flex flex-wrap items-center justify-between gap-4 border-t border-slate-100">

            <!-- Like Button -->
            <form action="{{ route('posts.like', $post) }}" method="POST">
                @csrf
                <button type="submit"
                        class="flex items-center gap-2 bg-white border border-slate-200 hover:border-red-300 hover:bg-red-50 text-slate-600 hover:text-red-500 px-4 py-2.5 rounded-xl text-sm font-semibold transition-colors">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                    </svg>
                    Suka ({{ $post->likes }})
                </button>
            </form>

            <!-- Edit / Delete — owner only -->
            @if(auth()->id() === $post->user_id)
            <div class="flex items-center gap-2">
                <a href="{{ route('posts.edit', $post) }}"
                   class="inline-flex items-center gap-1.5 bg-amber-500 hover:bg-amber-600 text-white px-4 py-2.5 rounded-xl text-sm font-semibold transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit
                </a>

                <form action="{{ route('posts.destroy', $post) }}" method="POST"
                      onsubmit="return confirm('Yakin ingin menghapus diskusi ini?')">
                    @csrf @method('DELETE')
                    <button type="submit"
                            class="inline-flex items-center gap-1.5 bg-red-500 hover:bg-red-600 text-white px-4 py-2.5 rounded-xl text-sm font-semibold transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Hapus
                    </button>
                </form>
            </div>
            @endif
        </div>
    </article>

</div>
@endsection
