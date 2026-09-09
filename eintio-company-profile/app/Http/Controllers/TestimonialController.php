<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;


class TestimonialController extends Controller
{

    public function index()
    {
        $testimonials = Testimonial::where('status', 'approved')
            ->latest('submitted_at')
            ->get();

        $total = $testimonials->count();

        $averageRating = $total > 0
            ? number_format($testimonials->avg('rating'), 1)
            : 0;


        return view('testimoni.index', compact(
            'testimonials',
            'total',
            'averageRating'
        ));
    }



    public function store(Request $request)
    {
        $request->validate([

            'name'=>'required',
            'organization'=>'required',
            'service'=>'required',
            'rating'=>'required',
            'message'=>'required',

        ]);


        Testimonial::create([

            'client_name'=>$request->name,

            'client_institution'=>$request->organization,

            'client_position'=>$request->service,

            'testimoni'=>$request->message,

            'rating'=>$request->rating,

            'category'=>strtolower($request->service),

            'status'=>'pending',

            'submitted_at'=>now(),

        ]);


        return redirect()
            ->back()
            ->with(
                'success',
                'Testimoni berhasil dikirim dan menunggu persetujuan.'
            );
    }

}