<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Webinar;
use App\Models\WebinarParticipant;
use Illuminate\Http\Request;

class WebinarParticipantController extends Controller
{
    public function index(Request $request, Webinar $webinar)
    {
        $participants = $webinar->participants()
            ->when($request->search, fn ($q) => $q->where('name', 'like', "%{$request->search}%"))
            ->when($request->status && $request->status !== 'all', fn ($q) => $q->where('status', $request->status))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.webinars.participants.index', compact('webinar', 'participants'));
    }

    public function show(Webinar $webinar, WebinarParticipant $participant)
    {
        return view('admin.webinars.participants.show', compact('webinar', 'participant'));
    }
}