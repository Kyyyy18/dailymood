@extends('layouts.layout')

@section('title', 'Edit Catatan Mood - DailyMood')

@section('content')
<div class="card">
    <h2 style="margin-bottom: 25px; color: #1a1a2e; font-size: 28px; font-weight: 700;">✏️ Edit Catatan Mood</h2>

    <form action="{{ route('daily-moods.update', $dailyMood->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Mood Saat Ini:</label>
            <div style="padding: 15px; background: #f8f9fa; border-radius: 8px; display: flex; align-items: center; gap: 15px;">
                @if($dailyMood->mood->image)
                    <img src="{{ asset($dailyMood->mood->image) }}" alt="{{ $dailyMood->mood->name }}" style="width: 60px; height: 60px; object-fit: contain;">
                @else
                    <span style="font-size: 24px;">{{ $dailyMood->mood->emoji }}</span>
                @endif
                <span style="font-size: 18px; font-weight: 600;">{{ $dailyMood->mood->name }}</span>
            </div>
            <small style="color: #666;">Catatan: Tipe mood tidak dapat diubah. Anda hanya dapat mengedit alasan dan tanggal.</small>
        </div>

        <div class="form-group">
            <label for="reason">Mengapa Anda merasa seperti ini?</label>
            <textarea name="reason" id="reason" class="form-control" placeholder="Jelaskan apa yang membuat Anda merasa seperti ini..." required>{{ old('reason', $dailyMood->reason) }}</textarea>
            @error('reason')
                <div style="color: #dc3545; margin-top: 5px; font-size: 14px;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="mood_date">Tanggal:</label>
            <input type="date" name="mood_date" id="mood_date" class="form-control" value="{{ old('mood_date', $dailyMood->mood_date->format('Y-m-d')) }}" required>
            @error('mood_date')
                <div style="color: #dc3545; margin-top: 5px; font-size: 14px;">{{ $message }}</div>
            @enderror
        </div>

        <div style="display: flex; gap: 10px; margin-top: 30px;">
            <button type="submit" class="btn btn-success"> Perbarui Catatan Mood</button>
            <a href="{{ route('daily-moods.index') }}" class="btn btn-secondary">❌ Batal</a>
        </div>
    </form>
</div>
@endsection

