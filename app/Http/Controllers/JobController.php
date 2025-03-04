<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Jobs;
use App\Models\Pinned;
use App\Models\JobType;
use App\Models\Companies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $selectedJobTypes = $request->input('jobType', []);
        $selectedExperienceLevels = $request->input('experienceLevel', []);

        $jobs = Jobs::with(['companies', 'pinnedUsers'])
            ->when($search, function ($query, $search) {
                $query->where('job_title', 'like', '%' . $search . '%')
                    ->orWhereHas('companies', function ($q) use ($search) {
                        $q->where('company_name', 'like', '%' . $search . '%')
                            ->orWhere('company_address', 'like', '%' . $search . '%');
                    });
            })
            ->when(!empty($selectedJobTypes), function ($query) use ($selectedJobTypes) {
                $query->where(function ($q) use ($selectedJobTypes) {
                    foreach ($selectedJobTypes as $type) {
                        $q->orWhere('job_type', 'like', '%' . $type . '%');
                    }
                });
            })
            ->when(!empty($selectedExperienceLevels), function ($query) use ($selectedExperienceLevels) {
                $query->where(function ($q) use ($selectedExperienceLevels) {
                    foreach ($selectedExperienceLevels as $level) {
                        $q->orWhere('job_type', 'like', '%' . $level . '%');
                    }
                });
            })
            ->where('is_active', true)
            ->latest()
            ->get();

        $activeJobs = Jobs::select('job_type')->where('is_active', true)->get();
        $jobTypeCounts = [];

        foreach ($activeJobs as $job) {
            $types = explode(',', $job->job_type);
            foreach ($types as $type) {
                $type = trim($type);
                if ($type !== '') {
                    $jobTypeCounts[$type] = ($jobTypeCounts[$type] ?? 0) + 1;
                }
            }
        }

        if ($request->ajax()) {
            return response()->json([
                'jobs' => $jobs,
            ]);
        }

        return view('menus.job', compact('jobs', 'jobTypeCounts'));
    }


    public function detail(Jobs $job)
    {
        $keywords = preg_split('/\s+/', $job->job_title, -1, PREG_SPLIT_NO_EMPTY);

        $similarJobs = Jobs::where('id', '!=', $job->id)
            ->where('is_active', true)
            ->where(function ($query) use ($keywords) {
                foreach ($keywords as $keyword) {
                    $query->orWhere('job_title', 'LIKE', '%' . $keyword . '%');
                }
            })
            ->get();

        $selectedJobTypes = explode(',', $job->job_type);
        $selectedJobTypes = array_map('trim', $selectedJobTypes);

        return view('menus.job_detail', compact('job', 'similarJobs', 'selectedJobTypes'));
    }



    public function pin(Jobs $job)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'Not authenticated'], 403);
        }

        $pinned = Pinned::where('job_id', $job->id)
            ->where('user_id', $user->id)
            ->first();

        if ($pinned) {
            $pinned->delete();
            return response()->json(['status' => 'removed']);
        } else {
            Pinned::create([
                'job_id' => $job->id,
                'user_id' => $user->id,
            ]);
            return response()->json(['status' => 'success']);
        }
    }

    public function remove(Request $request, Jobs $job)
    {

        $job->update(['is_active' => false]);

        return redirect('job');
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
            'jobTitle' => 'required',
            'companyName' => 'required',
            'location' => 'required',
            'companyEmail' => 'required|email',
            'salary' => 'required',
            'jobType' => 'required|array',
            'description' => 'required',
            'end_date' => 'required|date',
            'qualifications' => 'array|max:10',
            'responsibilities' => 'array|max:10',
        ]);

        // Hapus separator ribuan (titik) dari input salary
        $salary = str_replace('.', '', $validated['salary']);

        $jobType = implode(',', $validated['jobType']);
        $qualifications = implode(',', array_filter($validated['qualifications'] ?? []));
        $responsibilities = implode(',', array_filter($validated['responsibilities'] ?? []));

        $company = Companies::create([
            'company_name' => $validated['companyName'],
            'company_email' => $validated['companyEmail'],
            'company_address' => $validated['location']
        ]);

        $isActive = Carbon::now()->lt(Carbon::parse($validated['end_date']));

        Jobs::create([
            'job_title' => $validated['jobTitle'],
            'job_description' => $validated['description'],
            'job_type' => $jobType,
            'qualification' => $qualifications,
            'responsibility' => $responsibilities,
            'salary' => $salary,
            'company_id' => $company->id,
            'user_id' => auth()->id(),
            'end_date' => $validated['end_date'],
            'is_active' => $isActive,
        ]);

        return redirect()->back()->with('success', 'Job posted successfully');
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
    public function update(Request $request, $id)
    {
        try {

            $request->validate([
                'jobTitle' => ['required', 'string', 'max:255'],
                'companyName' => ['required', 'string', 'max:255'],
                'location' => ['required', 'string', 'max:255'],
                'companyEmail' => ['required', 'email'],
                'salary' => ['required'],
                'end_date' => ['required', 'date'],
                'description' => ['required', 'string'],
                'jobType' => ['required', 'array'],
                'qualifications' => ['required', 'array'],
                'responsibilities' => ['required', 'array'],
            ]);

            // dd($request->all());

            $salary = str_replace('.', '', $request['salary']);

            $job = Jobs::find($id);

            $job->update([
                'job_title' => $request['jobTitle'],
                'salary' => $salary,
                'end_date' => $request['end_date'],
                'job_description' => $request['description'],
                'job_type' => implode(',', $request['jobType']),
            ]);

            $company = $job->companies()->first();

            $company->update([
                'company_name' => $request['companyName'],
                'company_address' => $request['location'],
                'company_email' => $request['companyEmail'],
            ]);

            $job->update([
                'qualification' => implode(',', $request['qualifications']),
                'responsibility' => implode(',', $request['responsibilities']),
            ]);

            return redirect()->route('jobs.show', $job->id);
        } catch (\Exception $e) {
            Log::error('Failed to create user: ' . $e->getMessage(), [
                'exception' => $e
            ]);

            notify()->error('Failed to create user. Please try again.', 'Failed!');
            return redirect()->back();
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
