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


    public function index()
    {
        return Inertia::render('admin/cash-draw');
    }
}
