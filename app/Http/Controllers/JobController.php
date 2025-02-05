<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobType;
use App\Models\Job;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobTypes = JobType::all();
        return view('menus.job', compact('jobTypes'));
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
        //
    }
    public function addJobType(Request $request)
    {
        $validated = $request->validate([
            'job_type_name' => 'required|string|max:255',
        ]);

        // Simpan data ke database
        $jobType = JobType::create([
            'job_type_name' => $validated['job_type_name']
        ]);

        // Kembalikan respon JSON
        return response()->json([
            'status'  => 'success',
            'message' => 'Job type berhasil ditambahkan.',
            'data'    => $jobType
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
