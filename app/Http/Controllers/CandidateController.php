<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobPost;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CandidateController extends Controller
{
    use AuthorizesRequests;
    // Dashboard
    public function dashboard()
    {
        $user = Auth::user();
        $applications = Application::where('user_id', $user->id)
            ->with('job')
            ->latest()
            ->get();

        return view('candidate.dashboard', compact('user', 'applications'));
    }

    // Profile
    public function editProfile()
    {
        $user = Auth::user();
        return view('candidate.edit-profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'phone' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:255',
            'resume' => 'nullable|mimes:pdf|max:2048',
        ]);

        if ($request->hasFile('resume')) {
            $user->resume = $request->file('resume')->store('resumes', 'public');
        }

        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->save();

        return back()->with('success', 'Profile updated.');
    }

    // Jobs
    public function jobPosts()
    {
        $jobs = JobPost::latest()->paginate(5);
        return view('candidate.job-posts', compact('jobs'));
    }

    public function showApplyForm(JobPost $job)
    {
        $user = Auth::user();
        return view('candidate.apply', compact('job', 'user'));
    }

    public function submitApplication(Request $request, JobPost $job)
    {
        $user = Auth::user();

        $request->validate([
            'resume' => 'nullable|mimes:pdf|max:2048',
        ]);

        $resume = $user->resume;
        if ($request->hasFile('resume')) {
            $resume = $request->file('resume')->store('resumes', 'public');
        }

        Application::create([
            'user_id' => $user->id,
            'job_id' => $job->id,
            'resume' => $resume,
            'status' => 'pending',
        ]);

        return redirect()->route('candidate.applications')->with('success', 'Application submitted.');
    }

    // Applications CRUD
    public function applications()
    {
        $user = Auth::user();
        $applications = Application::where('user_id', $user->id)->with('job')->latest()->get();
        return view('candidate.applications', compact('applications'));
    }

    public function editApplication(Application $application)
    {
        if ($application->user_id !== Auth::id()) {
            abort(403);
        }

        $user = Auth::user();
        return view('candidate.edit-application', compact('application', 'user'));
    }

    public function updateApplication(Request $request, Application $application)
    {
        if ($application->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'resume' => 'nullable|mimes:pdf|max:2048',
            'status' => 'required|in:pending,accepted,rejected',
        ]);

        if ($request->hasFile('resume')) {
            $application->resume = $request->file('resume')->store('resumes', 'public');
        }

        $application->status = $request->status;
        $application->save();

        return back()->with('success', 'Application updated.');
    }

    public function deleteApplication(Application $application)
    {
        if ($application->user_id !== Auth::id()) {
            abort(403);
        }

        $application->delete();
        return back()->with('success', 'Application deleted.');
    }
}
