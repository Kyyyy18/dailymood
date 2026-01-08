<?php

namespace Database\Seeders;

use App\Models\Mood;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $moods = [
            [
                'name' => 'Sangat Marah',
                'emoji' => '😠',
                'image' => 'images/moods/so-mad.png',
                'suggestion' => 'Ambil napas dalam-dalam dan hitung sampai sepuluh. Coba berjalan-jalan atau melakukan olahraga ringan untuk melepaskan ketegangan. Pertimbangkan untuk berbicara dengan seseorang yang Anda percayai tentang apa yang mengganggu Anda.',
            ],
            [
                'name' => 'Sangat Bahagia',
                'emoji' => '😄',
                'image' => 'images/moods/so-happy.png',
                'suggestion' => 'Bagikan kebahagiaan Anda dengan orang lain! Sebarkan energi positif dengan melakukan sesuatu yang baik untuk orang lain. Pertimbangkan untuk menulis jurnal tentang apa yang membuat Anda bahagia hari ini untuk mengingat perasaan ini.',
            ],
            [
                'name' => 'Biasa Saja',
                'emoji' => '😐',
                'image' => 'images/moods/just-okay.png',
                'suggestion' => 'Coba lakukan sesuatu yang baru atau terlibat dalam hobi yang Anda nikmati. Perubahan kecil dalam rutinitas atau aktivitas kreatif mungkin bisa membantu meningkatkan semangat Anda.',
            ],
            [
                'name' => 'Sedih',
                'emoji' => '😔',
                'image' => 'images/moods/feeling-down.png',
                'suggestion' => 'Ingatlah bahwa tidak apa-apa untuk merasakan hal ini. Coba dengarkan musik yang membangkitkan semangat, menghabiskan waktu di alam, atau menghubungi teman. Pertimbangkan untuk mempraktikkan rasa syukur dengan menuliskan tiga hal yang Anda syukuri.',
            ],
            [
                'name' => 'Kecewa',
                'emoji' => '😞',
                'image' => 'images/moods/disappointed.png',
                'suggestion' => 'Akui perasaan Anda dan beri diri Anda waktu untuk memproses. Fokus pada apa yang bisa Anda pelajari dari pengalaman ini. Coba temukan satu aspek positif atau peluang yang mungkin muncul dari situasi ini.',
            ],
        ];

        foreach ($moods as $mood) {
            Mood::create($mood);
        }
    }
}
