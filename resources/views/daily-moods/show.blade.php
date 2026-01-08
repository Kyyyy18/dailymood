@extends('layouts.layout')

@section('title', 'Detail Catatan Mood - DailyMood')

@section('content')
@extends('layouts.layout')

@section('title', 'Detail Mood - DailyMood')

@section('content')
<div style="max-width: 800px; margin: 0 auto;">
    <div style="margin-bottom: 2rem; display: flex; align-items: center; justify-content: space-between;">
        <div>
            <a href="{{ route('daily-moods.index') }}" style="color: var(--text-muted); text-decoration: none; font-size: 0.875rem; display: inline-flex; align-items: center; gap: 0.5rem; margin-bottom: 0.5rem;">
                ← Kembali ke Riwayat
            </a>
            <h2 style="font-size: 1.875rem; color: var(--text-heading); font-weight: 700; letter-spacing: -0.025em; margin: 0;">Detail Catatan</h2>
        </div>
        <div style="display: flex; gap: 0.5rem;">
            <a href="{{ route('daily-moods.edit', $dailyMood->id) }}" class="btn btn-secondary">Edit</a>
            <form action="{{ route('daily-moods.destroy', $dailyMood->id) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus catatan ini?')">Hapus</button>
            </form>
        </div>
    </div>

    <div class="card">
         <div style="display: flex; gap: 2rem; align-items: flex-start; border-bottom: 1px solid var(--border-color); padding-bottom: 2rem; margin-bottom: 2rem;">
            @if($dailyMood->mood->image)
                <div style="flex-shrink: 0; padding: 1rem; background: #f8fafc; border-radius: var(--radius-lg); border: 1px solid var(--border-color);">
                    <img src="{{ asset($dailyMood->mood->image) }}" alt="{{ $dailyMood->mood->name }}" style="width: 100px; height: 100px; object-fit: contain;">
                </div>
            @else
                <div style="flex-shrink: 0; width: 100px; height: 100px; display: flex; align-items: center; justify-content: center; background: #f8fafc; border-radius: var(--radius-lg); border: 1px solid var(--border-color); font-size: 4rem;">
                    {{ $dailyMood->mood->emoji }}
                </div>
            @endif
            
            <div>
                <div style="font-size: 0.875rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em; font-weight: 600; margin-bottom: 0.5rem;">Mood Anda</div>
                <h3 style="margin: 0; color: var(--text-heading); font-size: 2rem; font-weight: 700; line-height: 1.2;">{{ $dailyMood->mood->name }}</h3>
                <div style="margin-top: 0.5rem; color: var(--text-body); font-size: 1rem;">
                    {{ $dailyMood->mood_date->format('l, d F Y') }}
                </div>
            </div>
        </div>

        <div style="margin-bottom: 2rem;">
            <h4 style="font-size: 1rem; color: var(--text-heading); margin-bottom: 1rem;">Cerita di balik mood ini</h4>
            <div style="background: #f8fafc; padding: 1.5rem; border-radius: var(--radius); border: 1px solid var(--border-color); color: var(--text-body); line-height: 1.7;">
                {{ $dailyMood->reason }}
            </div>
        </div>

         <div class="alert alert-info" style="display: flex; gap: 1rem; align-items: flex-start;">
            <span style="font-size: 1.5rem;">💡</span>
            <div>
                <h3 style="font-size: 1rem; color: #075985; margin-bottom: 0.5rem;">Saran untuk Anda</h3>
                <p style="margin: 0; line-height: 1.6; color: #0c4a6e;">{{ $dailyMood->mood->suggestion }}</p>
            </div>
        </div>
    </div>
</div>
@endsection

