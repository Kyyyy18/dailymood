@extends('layouts.layout')

@section('title', 'Detail Catatan Mood - DailyMood')

@section('content')
<div class="card">
    <h2 style="margin-bottom: 25px; color: #1a1a2e; font-size: 28px; font-weight: 700;"> Detail Catatan Mood</h2>

     <div class="mood-card" style="background: rgba(255, 255, 255, 0.9); border-left-color: #11a8d2; padding: 30px;">
        <div style="display: flex; align-items: center; margin-bottom: 20px;">
            @if($dailyMood->mood->image)
                <img src="{{ asset($dailyMood->mood->image) }}" alt="{{ $dailyMood->mood->name }}" style="width: 120px; height: 120px; object-fit: contain; margin-right: 20px;">
            @else
                <span class="mood-emoji">{{ $dailyMood->mood->emoji }}</span>
            @endif
            <div>
                <h3 style="margin: 0; color: #1a1a2e; font-size: 26px; font-weight: 700;">{{ $dailyMood->mood->name }}</h3>
                <div class="mood-date" style="font-size: 16px; margin-top: 5px;">
                    📅 {{ $dailyMood->mood_date->format('d F Y') }}
                </div>
            </div>
        </div>

        <div class="mood-reason" style="background: white; padding: 20px; border-radius: 8px; margin-bottom: 20px;">
            <strong style="color: #11a8d2; font-size: 16px; font-weight: 600;">Alasan:</strong>
            <p style="margin-top: 10px; font-size: 16px; line-height: 1.8;">{{ $dailyMood->reason }}</p>
        </div>

         <div class="suggestion-box">
            <h3 style="margin-bottom: 10px;">💡 Saran untuk Anda:</h3>
            <p style="margin: 0; line-height: 1.8;">{{ $dailyMood->mood->suggestion }}</p>
        </div>

        <div style="display: flex; gap: 10px; margin-top: 30px;">
            <a href="{{ route('daily-moods.edit', $dailyMood->id) }}" class="btn btn-success" style="text-decoration: none;">✏️ Edit</a>
            <form action="{{ route('daily-moods.destroy', $dailyMood->id) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus catatan mood ini?')">🗑️ Hapus</button>
            </form>
            <a href="{{ route('daily-moods.index') }}" class="btn btn-secondary" style="text-decoration: none;">← Kembali ke Riwayat</a>
        </div>
    </div>
</div>
@endsection

