<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobType;
use Carbon\Carbon;
use App\Models\Jobs;
use App\Models\Companies;
use App\Models\Pinned;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $jobs = Jobs::with(['companies', 'pinnedUsers'])
            ->when($search, function ($query, $search) {
                $query->where('job_title', 'like', '%' . $search . '%')
                    ->orWhereHas('companies', function ($q) use ($search) {
                        $q->where('company_name', 'like', '%' . $search . '%')
                            ->orWhere('company_address', 'like', '%' . $search . '%');
                    });
            })
            ->latest()
            ->get();

        if ($request->ajax()) {
            return response()->json([
                'jobs' => $jobs,
            ]);
        }

        $maxSalary = Jobs::max('salary');
        $formattedMaxSalary = number_format($maxSalary, 0, ',', '.');

        return view('menus.job', compact('jobs', 'formattedMaxSalary'));
    }

    public function detail(Jobs $job)
    {
        $keywords = preg_split('/\s+/', $job->job_title, -1, PREG_SPLIT_NO_EMPTY);

        $similarJobs = Jobs::where('id', '!=', $job->id)
            ->where(function ($query) use ($keywords) {
                foreach ($keywords as $keyword) {
                    $query->orWhere('job_title', 'LIKE', '%' . $keyword . '%');
                }
            })
            ->get();

        return view('menus.job_detail', compact('job', 'similarJobs'));
    }


    public function pin(Request $request, Jobs $job)
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
                'job_id'  => $job->id,
                'user_id' => $user->id,
            ]);
            return response()->json(['status' => 'success']);
        }
    }

    public function remove(Request $request, Jobs $job)
    {

        $job->update(['is_active' => false]);

        return redirect('menus.job');
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
            'salary' => $validated['salary'],
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
