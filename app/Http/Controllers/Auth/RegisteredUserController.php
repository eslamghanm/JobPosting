<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\ProfilePhotoService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    protected ProfilePhotoService $profilePhotoService;

    public function __construct(ProfilePhotoService $profilePhotoService)
    {
        $this->profilePhotoService = $profilePhotoService;
    }

    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', 'in:candidate,employer'],
            'profile_photo' => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:5120'], // 5MB max
        ]);

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        // Handle profile photo upload if provided
        if ($request->hasFile('profile_photo')) {
            // $file = $request->file('profile_photo');
            // dd($file->getClientOriginalName(), $file->getSize(), $file->getMimeType());
            try {
                $photoPath = $this->profilePhotoService->upload(
                    $request->file('profile_photo'),
                    $user->id
                );

                $user->update(['profile_photo_path' => $photoPath]);
            } catch (\Exception $e) {
                // Log the error but don't stop registration
                \Log::error('Profile photo upload failed during registration: ' . $e->getMessage());
            }
        }

        event(new Registered($user));

        Auth::login($user);

        // Redirect based on user role
        if ($user->role === 'employer') {
            return redirect()->route('employer.dashboard');
        } else {
            return redirect()->route('candidate.dashboard');
        }
    }
}
