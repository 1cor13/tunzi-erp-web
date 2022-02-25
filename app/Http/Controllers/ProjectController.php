<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\Customer;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $data)
    {
        $data->customers = Customer::latest()->get();

        if ($data->view_type == 'trashed') {
            $data->projects = Project::onlyTrashed()->latest()->get();
        }
        elseif ($data->view_type == 'with-trashed') {
            $data->projects = Project::withTrashed()->latest()->get();
        }
        else {
            $data->projects = Project::latest()->get();
        }
        return view('system.companies.projects.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $data)
    {
        return view('system.companies.projects.create', compact('data'));
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
            'project_name' => 'required|max:255',
            'customer_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'project_leader' => 'required',
            'project_team' => 'required',
            'image'  => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]); 

        $path = $request->file('image')->store('public/images');

        $project = new Project;

        $project->project_name = $request->get('project_name');
        $project->customer_id = $request->get('customer_id');
        $project->start_date = $request->get('start_date');
        $project->end_date = $request->get('end_date');
        $project->project_leader = $request->get('project_leader');
        $project->project_team = $request->get('project_team');
        $project->image = $path;
        $project->save();           

        return back()->with('success', 'Project Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Request $data)
    {
        return view('system.companies.projects.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::find($id);
        return view('system.companies.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'project_name' => 'required|max:255',
            'customer_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'project_leader' => 'required',
            'project_team' => 'required',
        ]);          

        $project = Project::find($id);

        if($request->hasFile('image')){
            $request->validate([
              'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);
            $path = $request->file('image')->store('public/images');
            $project->image = $path;
        }

        $project->project_name = $request->get('project_name');
        $project->customer_id = $request->get('customer_id');
        $project->start_date = $request->get('start_date');
        $project->end_date = $request->get('end_date');
        $project->project_leader = $request->get('project_leader');
        $project->project_team = $request->get('project_team');
        $project->save();    

        return back()->with('success', 'Project updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::find($id);
        $project->delete();        

        return back()->with('success', 'Project Deleted!');
    }
}
