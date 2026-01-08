<header style="background-color: var(--bg-card); border-bottom: 1px solid var(--border-color); padding: 1rem 0; margin-bottom: 2rem; position: sticky; top: 0; z-index: 50;">
    <div class="container" style="display: flex; justify-content: space-between; align-items: center; padding-top: 0; padding-bottom: 0;">
        <a href="{{ route('dashboard') }}" style="text-decoration: none; display: flex; align-items: center; gap: 0.75rem;">
            <div style="width: 32px; height: 32px; background: var(--primary); border-radius: 8px; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 18px;">D</div>
            <h1 style="font-size: 1.25rem; margin: 0; font-weight: 700; color: var(--text-heading); letter-spacing: -0.025em;">
                DailyMood
            </h1>
        </a>
        <nav style="display: flex; gap: 0.5rem;">
            <a href="{{ route('dashboard') }}" class="btn btn-secondary" style="border: none; background: transparent; box-shadow: none;">
                Dashboard
            </a>
            <a href="{{ route('daily-moods.index') }}" class="btn btn-secondary" style="border: none; background: transparent; box-shadow: none;">
                Riwayat
            </a>
            <a href="{{ route('daily-moods.create') }}" class="btn btn-primary">
                + Mood Baru
            </a>
        </nav>
    </div>
</header>
