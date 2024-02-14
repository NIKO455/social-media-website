<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\UploadFileTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    use UploadFileTrait;

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function profile($username): Response
    {
        $user = new UserResource(User::where('username', $username)->first());
        if (!Auth::check()) {
            return Inertia::render('Pages/VisitProfile', compact('user'));
        }
        return Inertia::render('Pages/UserProfile', compact('user'));

    }

    public function coverPhoto(Request $request, $id): RedirectResponse
    {
        $user = User::findorFail($id);
        $oldPath = $user->cover_path;
        $imagePath = $this->uploadFile($request, 'cover_path', $oldPath, 'public/users');
        $user->update(['cover_path' => $imagePath]);
        return redirect()->back()->with('message', 'Cover Photo Updated');
    }

    public function profilePhoto(Request $request, $id): RedirectResponse
    {
        $user = User::findorFail($id);
        $oldPath = $user->profile_path;
        $imagePath = $this->uploadFile($request, 'profile_path', $oldPath, 'public/users');
        $user->update(['avatar_path' => $imagePath]);
        return redirect()->back();
    }

    public function removeProfile($id): RedirectResponse
    {
        $user = User::findorFail($id);
        $this->deleteFile($user->avatar_path);
        $user->update(['avatar_path' => null]);
        return redirect()->back();
    }
}
