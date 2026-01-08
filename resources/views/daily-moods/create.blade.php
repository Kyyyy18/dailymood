@extends('layouts.layout')

@section('title', 'Tambah Mood Baru - DailyMood')

@section('content')
<div class="card">
    <h2 style="margin-bottom: 25px; color: #1a1a2e; font-size: 28px; font-weight: 700;">+ Tambah Catatan Mood Baru</h2>

    <form action="{{ route('daily-moods.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="mood_id">Pilih mood Anda:</label>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 15px; margin-top: 10px;">
                @foreach($moods as $mood)
                     <label style="cursor: pointer; border: 3px solid {{ old('mood_id') == $mood->id ? '#11a8d2' : '#e9ecef' }}; border-radius: 16px; padding: 20px; text-align: center; transition: all 0.3s ease; background: {{ old('mood_id') == $mood->id ? 'rgba(17, 168, 210, 0.08)' : 'white' }}; box-shadow: 0 2px 10px rgba(0,0,0,0.05);" onmouseover="this.style.borderColor='#11a8d2'; this.style.transform='translateY(-3px)'" onmouseout="this.style.borderColor='{{ old('mood_id') == $mood->id ? '#11a8d2' : '#e9ecef' }}'; this.style.transform='translateY(0)'">
                        <input type="radio" name="mood_id" value="{{ $mood->id }}" {{ old('mood_id') == $mood->id ? 'checked' : '' }} required style="display: none;">
                        @if($mood->image)
                            <img src="{{ asset($mood->image) }}" alt="{{ $mood->name }}" style="width: 100px; height: 100px; object-fit: contain; display: block; margin: 0 auto 10px;">
                        @else
                            <div style="font-size: 48px; margin-bottom: 10px;">{{ $mood->emoji }}</div>
                        @endif
                        <div style="font-weight: 600; color: #1a1a2e; font-size: 14px;">{{ $mood->name }}</div>
                    </label>
                @endforeach
            </div>
            @error('mood_id')
                <div style="color: #dc3545; margin-top: 5px; font-size: 14px;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="reason">Mengapa Anda merasa seperti ini?</label>
            <textarea name="reason" id="reason" class="form-control" placeholder="Jelaskan apa yang membuat Anda merasa seperti ini..." required>{{ old('reason') }}</textarea>
            @error('reason')
                <div style="color: #dc3545; margin-top: 5px; font-size: 14px;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="mood_date">Tanggal:</label>
            <input type="date" name="mood_date" id="mood_date" class="form-control" value="{{ old('mood_date', date('Y-m-d')) }}" required>
            @error('mood_date')
                <div style="color: #dc3545; margin-top: 5px; font-size: 14px;">{{ $message }}</div>
            @enderror
        </div>

        <div style="display: flex; gap: 10px; margin-top: 30px;">
            <button type="submit" class="btn btn-primary"> Simpan Catatan Mood</button>
            <a href="{{ route('daily-moods.index') }}" class="btn btn-secondary">❌ Batal</a>
        </div>
    </form>
</div>

@section('scripts')
<script>
    // Update border styling when mood is selected
    document.querySelectorAll('input[name="mood_id"]').forEach(radio => {
        radio.addEventListener('change', function() {
            document.querySelectorAll('label[style*="border"]').forEach(label => {
                label.style.borderColor = '#e0e0e0';
                label.style.background = 'white';
            });
             if (this.checked) {
                 this.closest('label').style.borderColor = '#11a8d2';
                 this.closest('label').style.background = 'rgba(17, 168, 210, 0.08)';
                 this.closest('label').style.boxShadow = '0 4px 15px rgba(17, 168, 210, 0.2)';
             }
        });
    });
</script>
@endsection

