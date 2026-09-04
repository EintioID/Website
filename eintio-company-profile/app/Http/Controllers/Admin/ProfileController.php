<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CoreValue;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $profile = Profile::first() ?? new Profile();
        $coreValues = CoreValue::orderBy('order')->get();

        return view('admin.profile.index', compact('profile', 'coreValues'));
    }

    public function edit()
    {
        $profile = Profile::first() ?? new Profile();
        $coreValues = CoreValue::orderBy('order')->get();

        return view('admin.profile.edit', compact('profile', 'coreValues'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'company_name'    => ['required', 'string', 'max:255'],
            'tagline'         => ['nullable', 'string', 'max:255'],
            'description'     => ['nullable', 'string'],
            'vision'          => ['nullable', 'string'],
            'mission'         => ['nullable', 'array'],
            'mission.*'       => ['nullable', 'string'],
            'logo'            => ['nullable', 'image', 'max:2048'],
            'favicon'         => ['nullable', 'image', 'max:512'],
            'address'         => ['nullable', 'string'],
            'phone'           => ['nullable', 'string', 'max:20'],
            'email'           => ['nullable', 'email', 'max:255'],
            'hero_badge'      => ['nullable', 'string', 'max:100'],
            'hero_title'      => ['nullable', 'string', 'max:255'],
            'hero_subtitle'   => ['nullable', 'string'],
            'hero_image'      => ['nullable', 'image', 'max:2048'],
            'cta_1_label'     => ['nullable', 'string', 'max:50'],
            'cta_1_url'       => ['nullable', 'string', 'max:255'],
            'cta_2_label'     => ['nullable', 'string', 'max:50'],
            'cta_2_url'       => ['nullable', 'string', 'max:255'],
        ]);

        $profile = Profile::first() ?? new Profile();

        if ($request->hasFile('logo')) {
            if ($profile->logo) {
                Storage::disk('public')->delete($profile->logo);
            }
            $validated['logo'] = $request->file('logo')->store('profile', 'public');
        }

        if ($request->hasFile('favicon')) {
            if ($profile->favicon) {
                Storage::disk('public')->delete($profile->favicon);
            }
            $validated['favicon'] = $request->file('favicon')->store('profile', 'public');
        }

        if ($request->hasFile('hero_image')) {
            if ($profile->hero_image) {
                Storage::disk('public')->delete($profile->hero_image);
            }
            $validated['hero_image'] = $request->file('hero_image')->store('profile', 'public');
        }

        if (isset($validated['mission'])) {
            $validated['mission'] = array_values(array_filter($validated['mission'], fn ($v) => trim((string) $v) !== ''));
        }

        $profile->fill($validated);
        $profile->save();

        return back()->with('success', 'Profil perusahaan berhasil diperbarui.');
    }

    public function storeCoreValue(Request $request)
    {
        $validated = $request->validate([
            'icon'        => ['required', 'string', 'max:100'],
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);

        $validated['order'] = CoreValue::max('order') + 1;

        CoreValue::create($validated);

        return back()->with('success', 'Nilai inti berhasil ditambahkan.');
    }

    public function updateCoreValue(Request $request, CoreValue $coreValue)
    {
        $validated = $request->validate([
            'icon'        => ['required', 'string', 'max:100'],
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);

        $coreValue->update($validated);

        return back()->with('success', 'Nilai inti berhasil diperbarui.');
    }

    public function destroyCoreValue(CoreValue $coreValue)
    {
        $coreValue->delete();

        return back()->with('success', 'Nilai inti berhasil dihapus.');
    }
}