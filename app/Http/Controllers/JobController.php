<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\JobType;
use App\Models\JobApplicant;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $data)
    {
        $data->departments = Department::latest()->get();
        $data->jobtypes = JobType::latest()->get();
        $data->jobapps = JobApplicant::latest()->get();

        if ($data->view_type == 'trashed') {
            $data->jobs = Job::onlyTrashed()->latest()->get();
        }
        elseif ($data->view_type == 'with-trashed') {
            $data->jobs = Job::withTrashed()->latest()->get();
        }
        else {
            $data->jobs = Job::latest()->get();
        }
        return view('system.companies.perform.jobs.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $data)
    {
        return view('system.companies.perform.jobs.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'department_id' => 'required',
            'job_title'=>'required',
            'job_location'=>'required',
            'job_type_id'=> 'required',
            'job_applicant_id'=> 'required',
            'num_of_vacancies' => 'required',
            'experience' => 'required',
            'age' => 'required',
            'salary_from' => 'required',
            'salary_to' => 'required',
            'start_date' => 'required',
            'expired_date' => 'required',
            'description'=> 'required',
            'status' => 'required'
        ]);         

        Job::create($request->all());    

        return back()->with('success', 'Job Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show(Request $data)
    {
        return view('system.companies.perform.jobs.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $job = Job::find($id);
        return view('system.companies.perform.jobs.edit', compact('job'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'department_id' => 'required',
            'job_title'=>'required',
            'job_location'=>'required',
            'job_type_id'=> 'required',
            'job_applicant_id'=> 'required',
            'num_of_vacancies' => 'required',
            'experience' => 'required',
            'age' => 'required',
            'salary_from' => 'required',
            'salary_to' => 'required',
            'start_date' => 'required',
            'expired_date' => 'required',
            'description'=> 'required',
            'status' => 'required'
        ]);                   

        $job = Job::find($id);

        $job->department_id = $request->get('department_id');
        $job->job_title = $request->get('job_title');
        $job->job_location = $request->get('job_location');
        $job->job_type_id = $request->get('job_type_id');
        $job->job_applicant_id = $request->get('job_applicant_id');
        $job->num_of_vacancies = $request->get('num_of_vacancies');
        $job->experience = $request->get('experience');
        $job->age = $request->get('age');
        $job->salary_from = $request->get('salary_from');
        $job->salary_to = $request->get('salary_to');
        $job->start_date = $request->get('start_date');
        $job->expired_date = $request->get('expired_date');
        $job->description = $request->get('description');
        $job->status = $request->get('status');
        $training->save();    

        return back()->with('success', 'Job updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $job = Job::find($id);
        $job->delete();        

        return back()->with('success', 'Job Deleted!');
    }
}
