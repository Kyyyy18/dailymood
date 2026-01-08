@extends('layouts.layout')

@section('title', 'Detail Catatan Mood - DailyMood')

@section('content')
<style>
    .mood-detail-container {
        max-width: 800px;
        margin: 0 auto;
    }
    .mood-header {
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .back-link {
        color: var(--text-muted);
        text-decoration: none;
        font-size: 0.875rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0.5rem;
    }
    .page-title {
        font-size: 1.875rem;
        color: var(--text-heading);
        font-weight: 700;
        letter-spacing: -0.025em;
        margin: 0;
    }
    .action-buttons {
        display: flex;
        gap: 0.5rem;
    }
    .mood-content {
        display: flex;
        gap: 2rem;
        align-items: flex-start;
        border-bottom: 1px solid var(--border-color);
        padding-bottom: 2rem;
        margin-bottom: 2rem;
    }
    .mood-image-wrapper {
        flex-shrink: 0;
        padding: 1rem;
        background: #f8fafc;
        border-radius: var(--radius-lg);
        border: 1px solid var(--border-color);
    }
    .mood-image {
        width: 100px;
        height: 100px;
        object-fit: contain;
    }
    .mood-emoji-placeholder {
        flex-shrink: 0;
        width: 100px;
        height: 100px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f8fafc;
        border-radius: var(--radius-lg);
        border: 1px solid var(--border-color);
        font-size: 4rem;
    }
    .mood-info-label {
        font-size: 0.875rem;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.05em;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }
    .mood-name {
        margin: 0;
        color: var(--text-heading);
        font-size: 2rem;
        font-weight: 700;
        line-height: 1.2;
    }
    .mood-date {
        margin-top: 0.5rem;
        color: var(--text-body);
        font-size: 1rem;
    }
    .story-section {
        margin-bottom: 2rem;
    }
    .story-title {
        font-size: 1rem;
        color: var(--text-heading);
        margin-bottom: 1rem;
    }
    .story-content {
        background: #f8fafc;
        padding: 1.5rem;
        border-radius: var(--radius);
        border: 1px solid var(--border-color);
        color: var(--text-body);
        line-height: 1.7;
    }
    .suggestion-alert {
        display: flex;
        gap: 1rem;
        align-items: flex-start;
    }
    .suggestion-icon {
        font-size: 1.5rem;
    }
    .suggestion-title {
        font-size: 1rem;
        color: #075985;
        margin-bottom: 0.5rem;
    }
    .suggestion-text {
        margin: 0;
        line-height: 1.6;
        color: #0c4a6e;
    }
</style>

<div class="mood-detail-container">
    <div class="mood-header">
        <div>
            <a href="{{ route('daily-moods.index') }}" class="back-link">
                <span>←</span> Kembali ke Riwayat
            </a>
            <h2 class="page-title">Detail Catatan</h2>
        </div>
        <div class="action-buttons">
            <a href="{{ route('daily-moods.edit', $dailyMood->id) }}" class="btn btn-secondary">Edit</a>
            <form action="{{ route('daily-moods.destroy', $dailyMood->id) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus catatan ini?')">Hapus</button>
            </form>
        </div>
    </div>

    <div class="card">
         <div class="mood-content">
            @if($dailyMood->mood->image)
                <div class="mood-image-wrapper">
                    <img src="{{ asset($dailyMood->mood->image) }}" alt="{{ $dailyMood->mood->name }}" class="mood-image">
                </div>
            @else
                <div class="mood-emoji-placeholder">
                    {{ $dailyMood->mood->emoji }}
                </div>
            @endif
            
            <div>
                <div class="mood-info-label">Mood Anda</div>
                <h3 class="mood-name">{{ $dailyMood->mood->name }}</h3>
                <div class="mood-date">
                    {{ $dailyMood->mood_date->format('l, d F Y') }}
                </div>
            </div>
        </div>

        <div class="story-section">
            <h4 class="story-title">Cerita di balik mood ini</h4>
            <div class="story-content">
                {{ $dailyMood->reason }}
            </div>
        </div>

         <div class="alert alert-info suggestion-alert">
            <span class="suggestion-icon">💡</span>
            <div>
                <h3 class="suggestion-title">Saran untuk Anda</h3>
                <p class="suggestion-text">{{ $dailyMood->mood->suggestion }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
