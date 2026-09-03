<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CoreValue;
use App\Models\Profile;
use Illuminate\Http\Request;

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
        // Halaman edit terpisah tidak dipakai lagi -- semua sudah inline
        // langsung di halaman index (tab Info Umum / Hero Beranda / Visi & Misi / Nilai Inti).
        return redirect()->route('admin.profile.index');
    }

    public function update(Request $request)
    {
        $request->validate([
            'company_name'   => 'required|string|max:255',
            'tagline'        => 'nullable|string|max:255',
            'description'    => 'nullable|string',
            'vision'         => 'nullable|string',
            'mission'        => 'nullable|array',
            'mission.*'      => 'nullable|string|max:500',
            'address'        => 'nullable|string',
            'phone'          => 'nullable|string|max:50',
            'email'          => 'nullable|email',
            'logo'           => 'nullable|image|max:2048',
            'favicon'        => 'nullable|image|max:512',
            'hero_badge'     => 'nullable|string|max:255',
            'hero_title'     => 'nullable|string|max:255',
            'hero_subtitle'  => 'nullable|string',
            'hero_image'     => 'nullable|image|max:4096',
            'cta_1_label'    => 'nullable|string|max:255',
            'cta_1_url'      => 'nullable|string|max:255',
            'cta_2_label'    => 'nullable|string|max:255',
            'cta_2_url'      => 'nullable|string|max:255',
        ]);

        $profile = Profile::firstOrNew([]);

        $data = $request->only([
            'company_name', 'tagline', 'description', 'vision',
            'address', 'phone', 'email',
            'hero_badge', 'hero_title', 'hero_subtitle',
            'cta_1_label', 'cta_1_url', 'cta_2_label', 'cta_2_url',
        ]);

        // Buang poin misi yang kosong sebelum disimpan sebagai JSON array
        $data['mission'] = array_values(array_filter(
            $request->input('mission', []),
            fn ($point) => trim((string) $point) !== ''
        ));

        foreach (['logo', 'favicon', 'hero_image'] as $field) {
            if ($request->hasFile($field)) {
                $data[$field] = $request->file($field)->store('profile', 'public');
            }
        }

        $profile->fill($data)->save();

        return redirect()->route('admin.profile.index')
            ->with('success', 'Profil perusahaan berhasil diperbarui');
    }

    public function storeCoreValue(Request $request)
    {
        $request->validate([
            'icon'        => 'required|string|max:100',
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        CoreValue::create([
            'icon'        => $request->icon,
            'title'       => $request->title,
            'description' => $request->description,
            'order'       => (CoreValue::max('order') ?? 0) + 1,
        ]);

        return back()->with('success', 'Nilai inti berhasil ditambahkan');
    }

    public function updateCoreValue(Request $request, CoreValue $coreValue)
    {
        $request->validate([
            'icon'        => 'required|string|max:100',
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $coreValue->update($request->only('icon', 'title', 'description'));

        return back()->with('success', 'Nilai inti berhasil diperbarui');
    }

    public function destroyCoreValue(CoreValue $coreValue)
    {
        $coreValue->delete();

        return back()->with('success', 'Nilai inti berhasil dihapus');
    }
}