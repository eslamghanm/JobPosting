<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CandidateController extends Controller
{
    // Dashboard
    public function dashboard()
    {
        $candidate = Auth::user()->candidate;

        $applications = $candidate->applications()
            ->with('job')
            ->latest()
            ->get();

        return view('candidate.dashboard', compact('candidate', 'applications'));
    }

    // Show Edit Profile Page
    public function editProfile()
    {
        $candidate = Auth::user()->candidate;
        return view('candidate.edit-profile', compact('candidate'));
    }

    // Update Profile
    public function updateProfile(Request $request)
    {
        $candidate = Auth::user()->candidate;

        $request->validate([
            'phone' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:255',
            'resume' => 'nullable|mimes:pdf|max:2048',
        ]);

        if ($request->hasFile('resume')) {
            $path = $request->file('resume')->store('resumes', 'public');
            $candidate->resume = $path;
        }

        $candidate->phone = $request->phone;
        $candidate->address = $request->address;
        $candidate->save();

        return back()->with('success', 'Profile updated.');
    }

    // Candidate Applications Page
    public function applications()
    {
        $candidate = Auth::user()->candidate;

        $applications = $candidate->applications()
            ->with('job')
            ->latest()
            ->get();

        return view('candidate.applications', compact('applications'));
    }
}
