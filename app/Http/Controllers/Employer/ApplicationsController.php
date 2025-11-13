<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index(Request $request)
{
    $userId = Auth::id();

    // Base query for this employer's applications (related to employer's jobs)
    $query = Application::whereHas('job', function($q) use ($userId) {
        $q->where('user_id', $userId);
    });

    // Filters
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    if ($request->filled('search')) {
        $query->whereHas('job', function($q) use ($request) {
            $q->where('title', 'like', '%' . $request->search . '%');
        });
    }

    if ($request->filled('from') && $request->filled('to')) {
        $query->whereBetween('created_at', [
            $request->from . ' 00:00:00',
            $request->to . ' 23:59:59'
        ]);
    }

    if ($request->filled('period')) {
        switch ($request->period) {
            case 'today':
                $query->whereDate('created_at', now());
                break;
            case 'this_week':
                $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                break;
            case 'this_month':
                $query->whereMonth('created_at', now()->month);
                break;
        }
    }

    // Summary counts
    $totalApplication = Application::whereHas('job', fn($q) => $q->where('user_id', $userId))->count();
    $pendingApplication = Application::whereHas('job', fn($q) => $q->where('user_id', $userId))->where('status', 'pending')->count();
    $AcceptedApplication = Application::whereHas('job', fn($q) => $q->where('user_id', $userId))->where('status', 'Accepted')->count();
    $RejectedApplication = Application::whereHas('job', fn($q) => $q->where('user_id', $userId))->where('status', 'Rejected')->count();

    $latestApplication = $query->latest()->paginate(5);

    return view('employer.applications.index', compact(
        'totalApplication',
        'pendingApplication',
        'AcceptedApplication',
        'RejectedApplication',
        'latestApplication'
    ));
}
public function show(Application $application)
{
    return view('employer.applications.show', compact('application'));
}
public function edit(Application $application)
{
    return view('employer.applications.edit', compact('application'));
}

public function update(Request $request, Application $application)
{
    $request->validate([
        'status' => 'required|in:pending,accepted,rejected',
    ]);

    $application->update([
        'status' => $request->status,
    ]);

    return redirect()->route('Applications.show', $application)
                     ->with('success', 'Application status updated successfully.');
}


}
