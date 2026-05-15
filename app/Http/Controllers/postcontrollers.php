<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // READ - tampilkan semua postingan
    public function index()
    {
        $posts = Post::latest()->paginate(6);
        return view('posts.index', compact('posts'));
    }

    // READ - detail satu postingan
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    // CREATE - form buat postingan baru
    public function create()
    {
        return view('posts.create');
    }

    // CREATE - simpan postingan baru
    public function store(Request $request)
    {
        $request->validate([
            'title'    => 'required|min:5|max:150',
            'author'   => 'required|min:2|max:50',
            'category' => 'required',
            'content'  => 'required|min:20',
        ], [
            'title.required'    => 'Judul wajib diisi.',
            'title.min'         => 'Judul minimal 5 karakter.',
            'author.required'   => 'Nama penulis wajib diisi.',
            'category.required' => 'Kategori wajib dipilih.',
            'content.required'  => 'Isi postingan wajib diisi.',
            'content.min'       => 'Isi postingan minimal 20 karakter.',
        ]);

        Post::create($request->only(['title', 'author', 'category', 'content']));

        return redirect()->route('posts.index')
            ->with('success', 'Postingan berhasil dibuat!');
    }

    // UPDATE - form edit postingan
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    // UPDATE - simpan perubahan
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title'    => 'required|min:5|max:150',
            'author'   => 'required|min:2|max:50',
            'category' => 'required',
            'content'  => 'required|min:20',
        ], [
            'title.required'    => 'Judul wajib diisi.',
            'title.min'         => 'Judul minimal 5 karakter.',
            'author.required'   => 'Nama penulis wajib diisi.',
            'category.required' => 'Kategori wajib dipilih.',
            'content.required'  => 'Isi postingan wajib diisi.',
            'content.min'       => 'Isi postingan minimal 20 karakter.',
        ]);

        $post->update($request->only(['title', 'author', 'category', 'content']));

        return redirect()->route('posts.show', $post)
            ->with('success', 'Postingan berhasil diperbarui!');
    }

    // DELETE - hapus postingan
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index')
            ->with('success', 'Postingan berhasil dihapus!');
    }

    // LIKE - tambah like
    public function like(Post $post)
    {
        $post->increment('likes');
        return back()->with('success', 'Kamu menyukai postingan ini!');
    }
}