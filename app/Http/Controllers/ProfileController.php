<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Http\Requests\ProfileSecurityRequest;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Tampilkan halaman edit profile.
     */
    public function edit(Request $request)
    {
        return view('profile.edit', [
            'user' => $request->user(),
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    /**
     * Update data profile user.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        $validated = $request->validated();

        // Kalau ada upload foto profil
        if ($request->hasFile('profile')) {
            $path = $request->file('profile')->store('profiles', 'public');
            $validated['profile'] = $path;
        }

        $user->fill($validated);
        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function updatePhoto(Request $request): RedirectResponse
    {
        $user = $request->user();

        $request->validate([
            'profile' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        $folder = 'assets/profile/' . $user->username;

        if ($user->profile && Storage::disk('public')->exists($user->profile)) {
            Storage::disk('public')->delete($user->profile);
        }

        $filename = uniqid() . '.' . $request->file('profile')->getClientOriginalExtension();
        Storage::disk('public')->putFileAs($folder, $request->file('profile'), $filename);

        $user->update([
            'profile' => $folder . '/' . $filename,
        ]);

        return back()->with('status', 'Foto profil berhasil diupdate.');
    }
    public function deletePhoto(Request $request): RedirectResponse
    {
        $user = $request->user();

        if ($user->profile && Storage::disk('public')->exists($user->profile)) {
            Storage::disk('public')->delete($user->profile);
            $user->profile = null;
            $user->save();
        }

        return back()->with('status', 'Foto profil berhasil dihapus.');
    }

    /**
     * Update email & password (security)
     */
    public function updateSecurity(ProfileSecurityRequest $request): RedirectResponse
    {
        $user = $request->user();

        $validated = $request->validated();

        $user->email = $validated['email'];

        if (!empty($validated['password'])) {
            $user->password = bcrypt($validated['password']);
        }

        $user->save();

        return back()->with('status', 'security-updated');
    }

    /**
     * Hapus akun user.
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
}
