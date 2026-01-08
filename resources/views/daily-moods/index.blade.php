@extends('layouts.layout')

@section('title', 'Riwayat Mood - DailyMood')

@section('content')
<div class="card">
    <h2 style="margin-bottom: 25px; color: #1a1a2e; font-size: 28px; font-weight: 700;"> Riwayat Mood Anda</h2>

    <!-- Filter by Date -->
    <form method="GET" action="{{ route('daily-moods.index') }}" style="margin-bottom: 20px;">
        <div class="form-group" style="display: flex; gap: 10px; align-items: end; flex-wrap: wrap;">
            <div style="flex: 1; min-width: 200px;">
                <label for="date" style="color: #1a1a2e;">Filter berdasarkan Tanggal:</label>
                <input type="date" name="date" id="date" class="form-control" value="{{ request('date') }}">
            </div>
            <div>
                <button type="submit" class="btn btn-primary">🔍 Filter</button>
                <a href="{{ route('daily-moods.index') }}" class="btn btn-secondary">🔄 Reset</a>
            </div>
        </div>
    </form>

    @if($dailyMoods->count() > 0)
        <div style="margin-top: 20px;">
            @foreach($dailyMoods as $dailyMood)
                 <div class="mood-card" style="border-left-color: #11a8d2;">
                    <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap;">
                        <div style="display: flex; align-items: center; flex: 1;">
                            @if($dailyMood->mood->image)
                                <img src="{{ asset($dailyMood->mood->image) }}" alt="{{ $dailyMood->mood->name }}" style="width: 70px; height: 70px; object-fit: contain; margin-right: 15px; border-radius: 12px;">
                            @else
                                <span class="mood-emoji">{{ $dailyMood->mood->emoji }}</span>
                            @endif
                            <div>
                                <h3 style="margin: 0; color: #1a1a2e; font-size: 22px; font-weight: 700;">{{ $dailyMood->mood->name }}</h3>
                                <div class="mood-date">
                                    📅 {{ $dailyMood->mood_date->format('d F Y') }}
                                </div>
                            </div>
                        </div>
                        <div style="display: flex; gap: 10px; margin-top: 10px; flex-wrap: wrap;">
                            <a href="{{ route('daily-moods.show', $dailyMood->id) }}" class="btn btn-primary" style="text-decoration: none;">👁️ Lihat</a>
                            <a href="{{ route('daily-moods.edit', $dailyMood->id) }}" class="btn btn-success" style="text-decoration: none;">✏️ Edit</a>
                            <form action="{{ route('daily-moods.destroy', $dailyMood->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus catatan mood ini?')">🗑️ Hapus</button>
                            </form>
                        </div>
                    </div>
                    <div class="mood-reason">
                        <strong style="color: #11a8d2;">Alasan:</strong> {{ $dailyMood->reason }}
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div style="text-align: center; padding: 40px; color: #6c757d;">
            <p style="font-size: 64px; margin-bottom: 20px;">😌</p>
            <p style="font-size: 18px; margin-bottom: 10px; font-weight: 600; color: #1a1a2e;">Tidak ada catatan mood ditemukan.</p>
            @if(request('date'))
                <p>Coba pilih tanggal yang berbeda atau <a href="{{ route('daily-moods.index') }}" style="color: #11a8d2;">lihat semua catatan</a>.</p>
            @else
                <p><a href="{{ route('daily-moods.create') }}" class="btn btn-primary" style="text-decoration: none; margin-top: 10px;">+ Tambah Mood Pertama</a></p>
            @endif
        </div>
    @endif
</div>
@endsection
