<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    public function index()
    {
        return view('admin.settings.index');
    }

    public function updatePreferences(Request $request)
    {
        $validated = $request->validate([
            'language'       => 'required|in:id,en',
            'theme'          => 'required|in:light,dark',
            'notify_enabled' => 'nullable|boolean',
        ]);

        $user = Auth::user();
        $user->language = $validated['language'];
        $user->theme = $validated['theme'];
        $user->notify_enabled = $request->boolean('notify_enabled');
        $user->save();

        return redirect()->route('admin.settings.index')->with('success', 'Preferensi berhasil disimpan!');
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password'      => 'required',
            'new_password'          => 'required|min:8|confirmed',
        ], [
            'current_password.required' => 'Password saat ini wajib diisi.',
            'new_password.required'     => 'Password baru wajib diisi.',
            'new_password.min'          => 'Password baru minimal 8 karakter.',
            'new_password.confirmed'    => 'Konfirmasi password tidak cocok.',
        ]);

        $user = Auth::user();

        if (!Hash::check($validated['current_password'], $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini tidak sesuai.'])->withInput();
        }

        $user->password = Hash::make($validated['new_password']);
        $user->save();

        return redirect()->route('admin.settings.index')->with('success', 'Password berhasil diperbarui!');
    }
}