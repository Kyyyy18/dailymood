@extends('layouts.layout')

@section('title', 'Edit Catatan Mood - DailyMood')

@section('content')
<div style="max-width: 800px; margin: 0 auto;">
    <div style="margin-bottom: 2rem; text-align: center;">
        <h2 style="font-size: 1.875rem; color: var(--text-heading); font-weight: 700; letter-spacing: -0.025em; margin-bottom: 0.5rem;">Edit Catatan</h2>
        <p style="color: var(--text-muted);">Perbarui detail perasaan Anda untuk hari ini.</p>
    </div>

    <div class="card">
        <form action="{{ route('daily-moods.update', $dailyMood->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label style="margin-bottom: 0.5rem; display: block;">Mood Terpilih</label>
                <div style="padding: 1.5rem; background: #f8fafc; border: 1px solid var(--border-color); border-radius: var(--radius-lg); display: flex; align-items: center; gap: 1.5rem; margin-bottom: 0.5rem;">
                    @if($dailyMood->mood->image)
                        <img src="{{ asset($dailyMood->mood->image) }}" alt="{{ $dailyMood->mood->name }}" style="width: 64px; height: 64px; object-fit: contain;">
                    @else
                        <span style="font-size: 2.5rem; line-height: 1;">{{ $dailyMood->mood->emoji }}</span>
                    @endif
                    <div>
                        <div style="font-size: 1.125rem; font-weight: 600; color: var(--text-heading);">{{ $dailyMood->mood->name }}</div>
                        <div style="font-size: 0.875rem; color: var(--text-muted);">Tipe mood tidak dapat diubah saat mengedit.</div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="reason">Ceritakan lebih lanjut</label>
                <textarea name="reason" id="reason" class="form-control" placeholder="Jelaskan apa yang membuat Anda merasa seperti ini..." style="min-height: 120px; resize: vertical;" required>{{ old('reason', $dailyMood->reason) }}</textarea>
                @error('reason')
                    <div style="color: var(--danger); margin-top: 0.5rem; font-size: 0.875rem;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="mood_date">Tanggal</label>
                <input type="date" name="mood_date" id="mood_date" class="form-control" value="{{ old('mood_date', $dailyMood->mood_date->format('Y-m-d')) }}" required style="max-width: 200px;">
                @error('mood_date')
                    <div style="color: var(--danger); margin-top: 0.5rem; font-size: 0.875rem;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid var(--border-color); display: flex; justify-content: flex-end; gap: 0.75rem;">
                <a href="{{ route('daily-moods.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary" style="padding-left: 2rem; padding-right: 2rem;">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection

