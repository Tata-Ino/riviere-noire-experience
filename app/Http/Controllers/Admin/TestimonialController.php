<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->get('filter', 'all');

        $query = Testimonial::query();

        if ($filter === 'published') {
            $query->where('is_published', true);
        } elseif ($filter === 'pending') {
            $query->where('is_published', false);
        }

        $testimonials = $query->latest()->paginate(15)->withQueryString();

        $stats = [
            'total' => Testimonial::count(),
            'published' => Testimonial::where('is_published', true)->count(),
            'pending' => Testimonial::where('is_published', false)->count(),
        ];

        return view('admin.testimonials.index', compact('testimonials', 'filter', 'stats'));
    }

    public function show(Testimonial $testimonial)
    {
        return view('admin.testimonials.show', compact('testimonial'));
    }

    public function togglePublish(Testimonial $testimonial)
    {
        $testimonial->update(['is_published' => !$testimonial->is_published]);

        $status = $testimonial->is_published ? 'publié' : 'mis en attente';

        return back()->with('success', "Témoignage {$status} avec succès.");
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();

        return back()->with('success', 'Témoignage supprimé avec succès.');
    }
}
