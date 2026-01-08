@extends('layouts.layout')

@section('title', 'Riwayat Mood - DailyMood')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <div>
        <h2 style="font-size: 1.5rem; color: var(--text-heading); margin-bottom: 0.5rem;">Riwayat Mood</h2>
        <p style="color: var(--text-muted); font-size: 0.875rem;">Pantau dan kelola catatan harian Anda.</p>
    </div>
    <a href="{{ route('daily-moods.create') }}" class="btn btn-primary">
        + Catat Mood
    </a>
</div>

<div class="card" style="padding: 0; overflow: hidden; border: 1px solid var(--border-color); box-shadow: var(--shadow-sm);">
    
    <!-- Filter Section with clean background -->
    <div style="padding: 1.25rem; background-color: #f8fafc; border-bottom: 1px solid var(--border-color);">
        <form method="GET" action="{{ route('daily-moods.index') }}" style="display: flex; gap: 1rem; align-items: center; margin: 0;">
            <div style="flex-grow: 1; max-width: 300px;">
                <label for="date" style="font-size: 0.75rem; font-weight: 600; text-transform: uppercase; color: var(--text-muted); margin-bottom: 0.25rem;">Filter Tanggal</label>
                <input type="date" name="date" id="date" class="form-control" value="{{ request('date') }}" style="padding: 0.5rem 0.75rem; font-size: 0.875rem;">
            </div>
            <div style="align-self: flex-end;">
                <button type="submit" class="btn btn-secondary" style="margin: 0;">Filter</button>
                @if(request('date'))
                    <a href="{{ route('daily-moods.index') }}" style="font-size: 0.875rem; color: var(--text-muted); text-decoration: none; margin-left: 0.75rem;">Reset</a>
                @endif
            </div>
        </form>
    </div>

    @if($dailyMoods->count() > 0)
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.875rem;">
                <thead style="background-color: #f1f5f9; color: var(--text-heading); font-weight: 600; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.05em;">
                    <tr>
                        <th style="padding: 0.75rem 1.5rem;">Tanggal</th>
                        <th style="padding: 0.75rem 1.5rem;">Mood</th>
                        <th style="padding: 0.75rem 1.5rem;">Alasan</th>
                        <th style="padding: 0.75rem 1.5rem; text-align: right;">Aksi</th>
                    </tr>
                </thead>
                <tbody style="divide-y: divide-y-reverse; border-top: 1px solid var(--border-color);">
                    @foreach($dailyMoods as $dailyMood)
                        <tr style="border-bottom: 1px solid var(--border-color); transition: background 0.1s;">
                            <td style="padding: 1rem 1.5rem; color: var(--text-body); white-space: nowrap;">
                                {{ $dailyMood->mood_date->format('d M Y') }}
                                <div style="font-size: 0.75rem; color: var(--text-muted);">{{ $dailyMood->mood_date->translatedFormat('l') }}</div>
                            </td>
                            <td style="padding: 1rem 1.5rem;">
                                <div style="display: flex; align-items: center; gap: 0.75rem;">
                                    @if($dailyMood->mood->image)
                                        <img src="{{ asset($dailyMood->mood->image) }}" alt="" style="width: 32px; height: 32px; border-radius: 6px; object-fit: contain; background: #f8fafc; border: 1px solid var(--border-color);">
                                    @else
                                        <span style="font-size: 1.5rem;">{{ $dailyMood->mood->emoji }}</span>
                                    @endif
                                    <span style="font-weight: 500; color: var(--text-heading);">{{ $dailyMood->mood->name }}</span>
                                </div>
                            </td>
                            <td style="padding: 1rem 1.5rem; max-width: 300px;">
                                <p style="margin: 0; color: var(--text-body); white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ Str::limit($dailyMood->reason, 50) }}</p>
                            </td>
                            <td style="padding: 1rem 1.5rem; text-align: right; white-space: nowrap;">
                                <a href="{{ route('daily-moods.show', $dailyMood->id) }}" style="color: var(--primary); text-decoration: none; margin-right: 0.75rem; font-weight: 500;">Lihat</a>
                                <a href="{{ route('daily-moods.edit', $dailyMood->id) }}" style="color: var(--text-muted); text-decoration: none; margin-right: 0.75rem; font-weight: 500;">Edit</a>
                                <form action="{{ route('daily-moods.destroy', $dailyMood->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background: none; border: none; color: var(--danger); cursor: pointer; font-weight: 500; font-family: inherit; font-size: inherit; padding: 0;" onclick="return confirm('Hapus catatan ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div style="text-align: center; padding: 4rem 2rem;">
            <div style="width: 64px; height: 64px; background: #f1f5f9; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem auto; font-size: 2rem;">📭</div>
            <h3 style="font-size: 1rem; color: var(--text-heading); margin-bottom: 0.5rem;">Belum ada catatan</h3>
            <p style="color: var(--text-muted); margin-bottom: 1.5rem;">Mulai lacak mood harian Anda sekarang.</p>
            <a href="{{ route('daily-moods.create') }}" class="btn btn-primary">Catat Mood Pertama</a>
        </div>
    @endif
</div>
@endsection
