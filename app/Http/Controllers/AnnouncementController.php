<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Announcement;
use App\Models\pinnedAnnouncement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categoryId = $request->query('category_id');

        $query = Announcement::with(['user', 'category'])
            ->where('remove_status', false)
            ->latest();

        if ($categoryId && $categoryId !== 'all') {
            $query->where('announcement_category_id', $categoryId);
        }

        $announcements = $query->get();

        if ($request->ajax()) {
            return response()->json([
                'announcements' => $announcements
            ]);
        }

        $categories = Category::all();

        $pinned = PinnedAnnouncement::with(['announcement.user', 'announcement.category'])
            ->where('user_id', auth()->id())
            ->where('is_pinned', true) // hanya ambil yang aktif
            ->get();

        return view('menus.announcement', compact('announcements', 'categories', 'pinned'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'text' => 'required|string',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'nullable|url',
            'remove_status' => 'boolean',
            'category_id' => 'required|exists:announcement_categories,id',
        ]);

        $imagePath = $request->hasFile('image_path')
            ? $request->file('image_path')->store('images', 'public')
            : null;

        Announcement::create([
            'created_by' => auth()->user()->id,
            'title' => $request->input('title'),
            'text' => $request->input('text'),
            'image_path' => $imagePath,
            'link' => $request->input('link'),
            'remove_status' => false,
            'announcement_category_id' => $request->input('category_id'),
        ]);

        return redirect()->back()->with('success', 'Announcement created successfully.');
    }

    public function pin($id)
    {
        $userId = auth()->id();

        $existing = PinnedAnnouncement::where('announcement_id', $id)
            ->where('user_id', $userId)
            ->first();

        if ($existing) {
            // Toggle status pinned
            $existing->update(['is_pinned' => !$existing->is_pinned]);
            return back()->with('success', $existing->is_pinned ? 'Announcement pinned.' : 'Announcement unpinned.');
        } else {
            PinnedAnnouncement::create([
                'announcement_id' => $id,
                'user_id' => $userId,
                'is_pinned' => true
            ]);
            return back()->with('success', 'Announcement pinned.');
        }
    }

    public function category(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
        ]);

        category::create([
            'category_name' => $request->input('category_name'),
        ]);
        return redirect()->back()->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $announcement = Announcement::with(['user', 'category'])
            ->where('id', $id)
            ->where('remove_status', false)
            ->firstOrFail();

        return view('menus.announcement_detail', compact('announcement'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'text' => 'required|string',
            'category_id' => 'required|exists:announcement_categories,id',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $announcement = Announcement::findOrFail($id);

        if (Auth::id() !== $announcement->created_by && Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $announcement->title = $request->title;
        $announcement->text = $request->text;
        $announcement->announcement_category_id = $request->category_id;

        if ($request->hasFile('image_path')) {
            if ($announcement->image_path && Storage::disk('public')->exists($announcement->image_path)) {
                Storage::disk('public')->delete($announcement->image_path);
            }

            $imagePath = $request->file('image_path')->store('announcements', 'public');
            $announcement->image_path = $imagePath;
        }

        $announcement->save();

        return redirect()->back()->with('success', 'Announcement updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $announcement = Announcement::findOrFail($id);

        if ($announcement->created_by !== auth()->user()->id) {
            return redirect()->back()->with('error', 'You are not authorized to delete this announcement.');
        }

        $announcement->update(['remove_status' => true]);

        return redirect()->back()->with('success', 'Announcement deleted successfully.');
    }
}
