<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::latest()->get();
        $totalReviews = $reviews->count();
        $averageRating = $reviews->avg('Rating');

        $ratings = Review::selectRaw('Rating, COUNT(*) as count')
                    ->groupBy('Rating')
                    ->pluck('count', 'Rating');

        return view('users.reviews', compact('reviews', 'averageRating', 'ratings', 'totalReviews'));
    }

    // ✅ Fungsi untuk halaman admin
    public function adminIndex()
    {
        $reviews = Review::latest()->get();
        $totalReviews = $reviews->count();
        $averageRating = $reviews->avg('Rating');

        $ratings = Review::selectRaw('Rating, COUNT(*) as count')
                    ->groupBy('Rating')
                    ->pluck('count', 'Rating');

                    return view('admin.review', compact('reviews', 'averageRating', 'ratings', 'totalReviews'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ReviewerName' => 'required|string|max:255',
            'Rating' => 'required|integer|min:1|max:5',
            'Comment' => 'nullable|string',
        ]);

        Review::create($request->only(['ReviewerName', 'Rating', 'Comment']));

        return redirect()->back()->with('success', 'Ulasan berhasil dikirim.');
    }

    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();
        return redirect()->back()->with('success', 'Ulasan berhasil dihapus.');
    }
    
    public function trashed()
{
    $reviews = Review::onlyTrashed()->latest()->get();
    return view('admin.riwayatulasan', compact('reviews'));
}

public function restore($id)
{
    $review = Review::onlyTrashed()->findOrFail($id);
    $review->restore();

    return redirect()->back()->with('success', 'Ulasan berhasil dipulihkan.');
}

}
