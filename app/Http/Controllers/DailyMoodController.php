<?php

namespace App\Http\Controllers;

use App\Models\DailyMood;
use App\Models\Mood;
use Illuminate\Http\Request;

class DailyMoodController extends Controller
{
    /**
     * Display the dashboard with calendar.
     */
    public function dashboard(Request $request)
    {
        // Get all dates that have mood entries for calendar
        $moodDates = DailyMood::selectRaw('DATE(mood_date) as date')
            ->distinct()
            ->pluck('date')
            ->map(function ($date) {
                return \Carbon\Carbon::parse($date)->format('Y-m-d');
            })
            ->toArray();

        // Get mood entries grouped by date for quick access
        $moodsByDate = DailyMood::with('mood')
            ->get()
            ->groupBy(function ($item) {
                return \Carbon\Carbon::parse($item->mood_date)->format('Y-m-d');
            })
            ->map(function ($items) {
                return $items->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'mood_name' => $item->mood->name,
                        'mood_emoji' => $item->mood->emoji,
                        'mood_image' => $item->mood->image,
                        'reason' => $item->reason,
                        'mood_date' => \Carbon\Carbon::parse($item->mood_date)->format('d F Y'),
                    ];
                });
            })
            ->toArray();

        // Get current month and year for calendar
        $currentMonth = $request->has('month') ? $request->month : now()->month;
        $currentYear = $request->has('year') ? $request->year : now()->year;

        return view('dashboard', compact('moodDates', 'moodsByDate', 'currentMonth', 'currentYear'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = DailyMood::with('mood')->orderBy('mood_date', 'desc')->orderBy('created_at', 'desc');

        // Filter by date if provided
        if ($request->has('date') && $request->date) {
            $query->whereDate('mood_date', $request->date);
        }

        $dailyMoods = $query->get();
        $moods = Mood::all();

        // Get all dates that have mood entries for calendar
        $moodDates = DailyMood::selectRaw('DATE(mood_date) as date')
            ->distinct()
            ->pluck('date')
            ->map(function ($date) {
                return \Carbon\Carbon::parse($date)->format('Y-m-d');
            })
            ->toArray();

        // Get mood entries grouped by date for quick access
        $moodsByDate = DailyMood::with('mood')
            ->get()
            ->groupBy(function ($item) {
                return \Carbon\Carbon::parse($item->mood_date)->format('Y-m-d');
            })
            ->map(function ($items) {
                return $items->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'mood_name' => $item->mood->name,
                        'mood_emoji' => $item->mood->emoji,
                        'mood_image' => $item->mood->image,
                        'reason' => $item->reason,
                        'mood_date' => \Carbon\Carbon::parse($item->mood_date)->format('d F Y'),
                    ];
                });
            })
            ->toArray();

        // Get current month and year for calendar
        $currentMonth = $request->has('month') ? $request->month : now()->month;
        $currentYear = $request->has('year') ? $request->year : now()->year;

        return view('daily-moods.index', compact('dailyMoods', 'moods', 'moodDates', 'moodsByDate', 'currentMonth', 'currentYear'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $moods = Mood::all();
        return view('daily-moods.create', compact('moods'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'mood_id' => 'required|exists:moods,id',
            'reason' => 'required|string|max:1000',
            'mood_date' => 'required|date',
        ]);

        $dailyMood = DailyMood::create($validated);
        $mood = Mood::find($validated['mood_id']);

        return redirect()->route('daily-moods.show', $dailyMood->id)
            ->with('success', 'Catatan mood berhasil disimpan!')
            ->with('suggestion', $mood->suggestion);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $dailyMood = DailyMood::with('mood')->findOrFail($id);
        return view('daily-moods.show', compact('dailyMood'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dailyMood = DailyMood::with('mood')->findOrFail($id);
        $moods = Mood::all();
        return view('daily-moods.edit', compact('dailyMood', 'moods'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dailyMood = DailyMood::findOrFail($id);

        $validated = $request->validate([
            'reason' => 'required|string|max:1000',
            'mood_date' => 'required|date',
        ]);

        $dailyMood->update($validated);

        return redirect()->route('daily-moods.index')
            ->with('success', 'Catatan mood berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dailyMood = DailyMood::findOrFail($id);
        $dailyMood->delete();

        return redirect()->route('daily-moods.index')
            ->with('success', 'Catatan mood berhasil dihapus!');
    }
}
