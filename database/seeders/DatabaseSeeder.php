<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat user demo
        $user = User::create([
            'name'     => 'Muhammad Hasby Abdillah',
            'email'    => 'hasby@demo.com',
            'password' => Hash::make('password123'),
        ]);

        // Buat beberapa post demo
        $posts = [
            [
                'title'    => 'Manfaat Belajar Coding di Era Digital',
                'category' => 'Teknologi',
                'content'  => 'Di era digital seperti sekarang, kemampuan coding menjadi salah satu skill yang paling dicari. Belajar coding tidak hanya membuka peluang karir yang luas, tetapi juga melatih kemampuan problem-solving dan berpikir logis. Mulailah dari bahasa pemrograman yang mudah seperti Python atau JavaScript.',
            ],
            [
                'title'    => 'Tips Menjaga Kesehatan Mental Mahasiswa',
                'category' => 'Kesehatan',
                'content'  => 'Kehidupan mahasiswa seringkali penuh tekanan antara tugas, ujian, dan kegiatan sosial. Penting untuk menjaga kesehatan mental dengan cara: istirahat cukup, olahraga rutin, berbagi cerita dengan teman, dan tidak ragu untuk meminta bantuan jika merasa kewalahan.',
            ],
            [
                'title'    => 'Gerakan Hidup Hijau di Pontianak',
                'category' => 'Lingkungan',
                'content'  => 'Kota Pontianak sedang mengembangkan berbagai program ramah lingkungan. Sebagai warga, kita bisa berkontribusi dengan mengurangi plastik sekali pakai, menanam tanaman di rumah, menggunakan transportasi umum, dan memilah sampah organik dan anorganik.',
            ],
        ];

        foreach ($posts as $p) {
            Post::create([...$p, 'user_id' => $user->id, 'likes' => rand(0, 20)]);
        }
    }
}
