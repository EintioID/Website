<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class UserProfileController extends Controller
{
    public function index()
    {
        return view('admin.account.index', ['user' => Auth::user()]);
    }

    public function edit()
    {
        return view('admin.account.edit', ['user' => Auth::user()]);
    }

    public function updateInfo(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:50', 'unique:users,username,' . $user->id],
            'email'    => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'phone'    => ['nullable', 'string', 'max:20'],
        ]);

        $user->update($validated);

        return redirect()->route('admin.account.index')
            ->with('success', 'Informasi profil berhasil diperbarui.');
    }

    public function updatePhoto(Request $request)
    {
        $request->validate([
            'photo' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $user = Auth::user();

        if ($user->photo) {
            Storage::disk('public')->delete($user->photo);
        }

        $user->photo = $request->file('photo')->store('profile-photos', 'public');
        $user->save();

        return redirect()->route('admin.account.index')
            ->with('success', 'Foto profil berhasil diperbarui.');
    }

    public function deletePhoto()
    {
        $user = Auth::user();

        if ($user->photo) {
            Storage::disk('public')->delete($user->photo);
            $user->photo = null;
            $user->save();
        }

        return redirect()->route('admin.account.index')
            ->with('success', 'Foto profil berhasil dihapus.');
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password'          => ['required', 'confirmed', Password::min(8)],
        ]);

        Auth::user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('admin.account.index')
            ->with('success', 'Password berhasil diperbarui.');
    }
}