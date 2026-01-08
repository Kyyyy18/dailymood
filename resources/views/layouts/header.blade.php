<header style="background: #ffffff; padding: 18px 0; box-shadow: 0 4px 20px rgba(17, 168, 210, 0.12); margin-bottom: 30px; position: sticky; top: 0; z-index: 1000;">
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
            <a href="{{ route('dashboard') }}" style="text-decoration: none;">
                <h1 style="font-size: 26px; margin: 0; font-weight: 700; color: #11a8d2;">
                    DailyMood
                </h1>
            </a>
            <nav style="display: flex; gap: 12px; flex-wrap: wrap;">
                <a href="{{ route('dashboard') }}" class="btn btn-secondary" style="text-decoration: none; padding: 12px 24px; position: relative; z-index: 10;">
                     Dashboard
                </a>
                <a href="{{ route('daily-moods.index') }}" class="btn btn-primary" style="text-decoration: none; padding: 12px 24px; position: relative; z-index: 10;">
                     Riwayat mood
                </a>
                <a href="{{ route('daily-moods.create') }}" class="btn btn-success" style="text-decoration: none; padding: 12px 24px; position: relative; z-index: 10;">
                    + Tambah
                </a>
            </nav>
        </div>
    </div>
</header>
