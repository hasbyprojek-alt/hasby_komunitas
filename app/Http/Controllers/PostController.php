<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // READ - tampilkan semua postingan dengan search & filter
    public function index(Request $request)
    {
        $query = Post::with('user')->latest();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $posts = $query->paginate(6)->withQueryString();

        return view('posts.index', compact('posts'));
    }

    // READ - detail satu postingan
    public function show(Post $post)
    {
        $post->load('user');
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
            'category' => 'required',
            'content'  => 'required|min:20',
        ], [
            'title.required'    => 'Judul wajib diisi.',
            'title.min'         => 'Judul minimal 5 karakter.',
            'category.required' => 'Kategori wajib dipilih.',
            'content.required'  => 'Isi postingan wajib diisi.',
            'content.min'       => 'Isi postingan minimal 20 karakter.',
        ]);

        auth()->user()->posts()->create([
            'title'    => $request->title,
            'category' => $request->category,
            'content'  => $request->content,
        ]);

        return redirect()->route('posts.index')
            ->with('success', 'Postingan berhasil dibuat! 🎉');
    }

    // UPDATE - form edit postingan
    public function edit(Post $post)
    {
        abort_if(auth()->id() !== $post->user_id, 403);
        return view('posts.edit', compact('post'));
    }

    // UPDATE - simpan perubahan
    public function update(Request $request, Post $post)
    {
        abort_if(auth()->id() !== $post->user_id, 403);

        $request->validate([
            'title'    => 'required|min:5|max:150',
            'category' => 'required',
            'content'  => 'required|min:20',
        ]);

        $post->update([
            'title'    => $request->title,
            'category' => $request->category,
            'content'  => $request->content,
        ]);

        return redirect()->route('posts.show', $post)
            ->with('success', 'Postingan berhasil diperbarui! ✅');
    }

    // DELETE - hapus postingan
    public function destroy(Post $post)
    {
        abort_if(auth()->id() !== $post->user_id, 403);
        $post->delete();

        return redirect()->route('posts.index')
            ->with('success', 'Postingan berhasil dihapus.');
    }

    // LIKE - tambah like
    public function like(Post $post)
    {
        $post->increment('likes');
        return back()->with('success', 'Kamu menyukai postingan ini! ❤️');
    }
}
