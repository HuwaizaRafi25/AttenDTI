<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobType;
use App\Models\Job;
use App\Models\Qualification;
use App\Models\Responsibility;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobTypes = JobType::all();
        $jobs = Job::with('jobTypes')->get();

        return view('menus.job', compact('jobTypes', 'jobs'));
    }

    public function detail(Job $job)
    {
        $job->load('jobTypes');
        return view('menus.job_detail', compact('job'));
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
        $validated = $request->validate([
            'jobTitle'         => 'required|string|max:255',
            'companyName'      => 'required|string|max:255',
            'location'         => 'required|string|max:255',
            'companyEmail'     => 'required|email',
            'salary'           => 'required|string|max:255',
            'jobType'          => 'required|array',
            'description'      => 'required|string',
            // Ubah validasi dari plural ke singular
            'qualification'    => 'nullable|array',
            'responsibility'   => 'nullable|array',
        ]);

        // Buat job dengan mapping field sesuai kolom tabel
        $job = Job::create([
            'job_title'       => $validated['jobTitle'],
            'company_name'    => $validated['companyName'],
            'company_email'   => $validated['companyEmail'],
            'location'        => $validated['location'],
            'salary'          => $validated['salary'],
            'job_description' => $validated['description'],
            'is_active'       => 1,
        ]);

        // Sinkronisasi job types melalui pivot table
        $job->jobTypes()->sync($validated['jobType']);

        // Simpan qualification melalui pivot many-to-many
        if (!empty($validated['qualification'])) {
            foreach ($validated['qualification'] as $qualificationContent) {
                $qualification = Qualification::create([
                    'qualification' => $qualificationContent
                ]);
                $job->qualifications()->attach($qualification->id);
            }
        }

        // Simpan responsibility melalui pivot many-to-many
        if (!empty($validated['responsibility'])) {
            foreach ($validated['responsibility'] as $responsibilityContent) {
                $responsibility = Responsibility::create([
                    'responsibility' => $responsibilityContent
                ]);
                $job->responsibilities()->attach($responsibility->id);
            }
        }

        return response()->json(['message' => 'Job posted successfully!']);
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
            'status' => 'success',
            'message' => 'Job type berhasil ditambahkan.',
            'data' => $jobType
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
