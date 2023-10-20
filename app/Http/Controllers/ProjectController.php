<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $projects = Project::all();

        return view('projects.list', ['projects' => $projects]);
    }

    // create
    public function create()
    {
        $users = User::pluck('name', 'id');
        return view('projects.create', ['users' => $users]);
    }

    // store
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'start_date' => 'required',
            'finish_date' => 'required',
            'cost' => 'required',
            'user_id' => 'required', // Añadir validación para user_id
        ]);

        $project = new Project();
        $project->name = $request->name;
        $project->location = $request->location;
        $project->start_date = $request->start_date;
        $project->finish_date = $request->finish_date;
        $project->cost = $request->cost;
        $project->user_id = $request->user_id;
        $project->save();

        return redirect()->route('projects.index', ['user' => auth()->user()->username])->with('success', 'Proyecto creado exitosamente.');

    }

    // edit
    public function edit($user, Project $project)
    {
        $users = User::pluck('name', 'id');
        return view('projects.edit', compact('project', 'users'));
    }

    // update
    public function update(Request $request, $user, Project $project)
    {
        $project->name = $request->name;
        $project->location = $request->location;
        $project->start_date = $request->start_date;
        $project->finish_date = $request->finish_date;
        $project->cost = $request->cost;
        $project->user_id = $request->user_id;
        $project->save();

        return redirect()->route('projects.index', ['user' => auth()->user()->username])->with('success', 'Proyecto actualizado exitosamente.');
    }

    // destroy
    public function destroy($user, Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index', ['user' => auth()->user()->username])->with('success', 'Proyecto eliminado exitosamente.');
    }
}
