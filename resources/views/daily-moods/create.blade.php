@extends('layouts.layout')

@section('title', 'Catat Mood - DailyMood')

@section('content')
<div style="max-width: 800px; margin: 0 auto;">
    <div style="margin-bottom: 2rem; text-align: center;">
        <h2 style="font-size: 1.875rem; color: var(--text-heading); font-weight: 700; letter-spacing: -0.025em; margin-bottom: 0.5rem;">Bagaimana perasaan Anda?</h2>
        <p style="color: var(--text-muted);">Refleksikan momen ini dan catat apa yang Anda rasakan.</p>
    </div>

    <div class="card">
        <form action="{{ route('daily-moods.store') }}" method="POST">
            @csrf

            <!-- Mood Selection Grid -->
            <div class="form-group">
                <label style="margin-bottom: 1rem; display: block;">Pilih Mood</label>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(140px, 1fr)); gap: 1rem;">
                    @foreach($moods as $mood)
                        <label class="mood-option" style="cursor: pointer; position: relative;">
                            <input type="radio" name="mood_id" value="{{ $mood->id }}" {{ old('mood_id') == $mood->id ? 'checked' : '' }} required style="position: absolute; opacity: 0; pointer-events: none;">
                            <div class="mood-box" style="border: 2px solid var(--border-color); border-radius: var(--radius-lg); padding: 1.5rem; text-align: center; transition: all 0.2s; height: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center; background: #ffffff;">
                                @if($mood->image)
                                    <img src="{{ asset($mood->image) }}" alt="{{ $mood->name }}" style="width: 64px; height: 64px; object-fit: contain; margin-bottom: 0.75rem;">
                                @else
                                    <div style="font-size: 2.5rem; margin-bottom: 0.5rem; line-height: 1;">{{ $mood->emoji }}</div>
                                @endif
                                <span style="font-weight: 600; color: var(--text-heading); font-size: 0.875rem;">{{ $mood->name }}</span>
                            </div>
                        </label>
                    @endforeach
                </div>
                @error('mood_id')
                    <div style="color: var(--danger); margin-top: 0.5rem; font-size: 0.875rem;">{{ $message }}</div>
                @enderror
            </div>

            <!-- Reason Input -->
            <div class="form-group">
                <label for="reason">Ceritakan lebih lanjut (Opsional)</label>
                <textarea name="reason" id="reason" class="form-control" placeholder="Apa yang terjadi? Apa yang memicu perasaan ini?" style="min-height: 120px; resize: vertical;" required>{{ old('reason') }}</textarea>
                @error('reason')
                    <div style="color: var(--danger); margin-top: 0.5rem; font-size: 0.875rem;">{{ $message }}</div>
                @enderror
            </div>

            <!-- Date Input -->
            <div class="form-group">
                <label for="mood_date">Tanggal</label>
                <input type="date" name="mood_date" id="mood_date" class="form-control" value="{{ old('mood_date', date('Y-m-d')) }}" required style="max-width: 200px;">
                @error('mood_date')
                    <div style="color: var(--danger); margin-top: 0.5rem; font-size: 0.875rem;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid var(--border-color); display: flex; justify-content: flex-end; gap: 0.75rem;">
                <a href="{{ route('daily-moods.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary" style="padding-left: 2rem; padding-right: 2rem;">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<style>
    .mood-option input:checked + .mood-box {
        border-color: var(--primary);
        background-color: var(--primary-bg);
        box-shadow: 0 0 0 1px var(--primary);
    }
    
    .mood-box:hover {
        border-color: var(--primary-hover);
        transform: translateY(-2px);
    }
</style>
<script>
    // No explicit JS needed for radio styling with the CSS sibling selector approach
</script>
@endsection
