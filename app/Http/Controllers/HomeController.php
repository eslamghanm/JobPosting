<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\JobPost;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index', [
            'categories' => Category::latest()->take(8)->get(),
            'trendJobs' => JobPost::withCount('applications')
            ->orderBy('applications_count', 'DESC')
            ->take(6)
            ->get()
        ]);
    }

    public function jobs()
    {
        return view('home.jobs', [
            'jobs' => JobPost::latest()->paginate(10)
        ]);
    }

    public function about()
    {
        return view('home.about');
    }

    public function contact()
    {
        return view('home.contact');
    }

    public function profile()
    {
        return view('home.profile');
    }
}
