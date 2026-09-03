<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    /**
     * Kategori layanan default yang selalu muncul di filter,
     * digabung dengan kategori lain yang mungkin sudah ada di data.
     */
    protected array $defaultCategories = [
        'Teknologi', 'Akademik', 'Bisnis', 'Individu', 'Pendidikan',
    ];

    public function index(Request $request)
    {
        $query = Testimonial::query();

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('client_name', 'like', "%{$search}%")
                  ->orWhere('client_institution', 'like', "%{$search}%")
                  ->orWhere('client_position', 'like', "%{$search}%")
                  ->orWhere('testimoni', 'like', "%{$search}%");
            });
        }

        if ($category = $request->input('category')) {
            $query->where('category', $category);
        }

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        $testimonials = $query->latest('submitted_at')
            ->paginate(5)
            ->withQueryString();

        $categories = collect($this->defaultCategories)
            ->merge(Testimonial::whereNotNull('category')->distinct()->pluck('category'))
            ->unique()
            ->sort()
            ->values();

        // Ringkasan rating (rata-rata keseluruhan, bisa dikembangkan per kategori kalau ada data sub-rating)
        $averageRating = round(Testimonial::where('status', 'approved')->avg('rating'), 1) ?: 0;
        $totalApproved = Testimonial::where('status', 'approved')->count();

        return view('admin.testimonials.index', [
            'testimonials' => $testimonials,
            'categories' => $categories,
            'averageRating' => $averageRating,
            'totalApproved' => $totalApproved,
            'filters' => [
                'search' => $search ?? '',
                'category' => $category ?? '',
                'status' => $status ?? '',
            ],
        ]);
    }

    public function show(Testimonial $testimonial)
    {
        return view('admin.testimonials.show', [
            'testimonial' => $testimonial,
        ]);
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', [
            'testimonial' => $testimonial,
        ]);
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $testimonial->update($validated);

        return redirect()
            ->route('admin.testimonials.index')
            ->with('success', 'Status testimoni berhasil diperbarui.');
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();

        return redirect()
            ->route('admin.testimonials.index')
            ->with('success', 'Testimoni berhasil dihapus.');
    }
}