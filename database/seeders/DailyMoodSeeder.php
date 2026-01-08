<?php

namespace Database\Seeders;

use App\Models\DailyMood;
use App\Models\Mood;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DailyMoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $moods = Mood::all();

        if ($moods->isEmpty()) {
            $this->command->warn('Tidak ada mood ditemukan. Silakan jalankan MoodSeeder terlebih dahulu.');
            return;
        }

        $sampleReasons = [
            'Hari ini adalah hari yang menyenangkan di tempat kerja!',
            'Merasa stres tentang ujian yang akan datang.',
            'Hanya merasa biasa saja, tidak ada yang istimewa terjadi.',
            'Menerima berita yang mengecewakan.',
            'Bertengkar dengan seorang teman.',
        ];

        $dates = [
            now()->subDays(2)->format('Y-m-d'),
            now()->subDays(1)->format('Y-m-d'),
            now()->format('Y-m-d'),
        ];

        for ($i = 0; $i < 3; $i++) {
            DailyMood::create([
                'mood_id' => $moods->random()->id,
                'reason' => $sampleReasons[$i] ?? 'Contoh alasan ' . ($i + 1),
                'mood_date' => $dates[$i],
            ]);
        }
    }
}
