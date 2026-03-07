<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessItems;
use App\Models\Item;
use App\Models\UserInterest;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class ProgressController extends Controller
{
    public function progress()
    {
        // إعادة ضبط التقدم
        Cache::put('progress', 0);

        // إرسال المهمة للـ Queue
        ProcessItems::dispatch();

        // إعادة توجيه الصفحة
        return Inertia::render('posts/Queue-Worker', [
            'progress' => Cache::get('progress', 0),
        ]);
    }

    public function start()
    {
        return response()->json([
            'progress' => Cache::get('progress', 0),
        ]);
    }


    public function showRecommendations()
    {
        $user = Auth::user(); // المستخدم الحالي
        $userInterests = $user->interests; // باستخدام العلاقة BelongsToMany

        if ($userInterests->isEmpty()) {
            return Inertia::render('posts/Queue-Worker', [
                'message' => 'هذا المستخدم لا يملك اهتمامات بعد.',
                'items' => [],
            ]);
        }

        $categories = $userInterests->pluck('category')->toArray();

        $recommendedItems = Item::whereIn('category', $categories)
            ->whereNotIn('id', $userInterests->pluck('id')->toArray())
            ->orderByRaw("FIELD(category, '".implode("','", $categories)."')")
            ->get();

        return Inertia::render('posts/Queue-Worker', [
            'items' => $recommendedItems,
            'message' => null,
        ]);
    }
}
