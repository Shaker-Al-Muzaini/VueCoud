<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class ProgressController extends Controller
{
    public function index()
    {
        return Inertia::render('admin/cash-draw');
    }

    public function index2()
    {
        return Inertia::render('admin/product_draws');
    }

    public function index3()
    {
        return Inertia::render('admin/winners');
    }

    public function index4()
    {
        return Inertia::render('admin/fAQs');
    }
    public function index5()
    {
        return Inertia::render('admin/contact');
    }
}
