<?php

namespace App\Http\Controllers;

use App\Models\Pay;
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
            'user_id' => 'required',
            'amount' => 'required'
        ]);

        $project = new Project();
        $project->name = $request->name;
        $project->location = $request->location;
        $project->start_date = $request->start_date;
        $project->finish_date = $request->finish_date;
        $project->cost = $request->cost;
        $project->user_id = $request->user_id;
        $project->user_id = $request->user_id;
        $project->save();

        // Crear un nuevo registro en la tabla "pays"
        $pay = new Pay();
        $pay->amount = $request->amount;
        $pay->project_id = $project->id;
        $pay->user_id = $request->user_id;
        $pay->save();

        return redirect()->route('projects.index', ['user' => auth()->user()->username])->with('success', 'Proyecto creado exitosamente.');

    }

    // edit
    public function edit($user, Project $project)
    {
        $users = User::pluck('name', 'id');
        $pay = Pay::where('project_id', $project->id)->first();

        return view('projects.edit', compact('project', 'users', 'pay'));
    }

    // update
    public function update(Request $request, $user, Project $project)
    {
        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'start_date' => 'required',
            'finish_date' => 'required',
            'cost' => 'required',
            'user_id' => 'required',
            'amount' => 'required'
        ]);

        $project->name = $request->name;
        $project->location = $request->location;
        $project->start_date = $request->start_date;
        $project->finish_date = $request->finish_date;
        $project->cost = $request->cost;
        $project->user_id = $request->user_id;
        $project->save();

        // Actualizar el registro de "pays" asociado al proyecto
        $pay = Pay::where('project_id', $project->id)->first();
        if ($pay) {
            $pay->amount = $request->amount;
            $pay->save();
        }

        return redirect()->route('projects.index', ['user' => auth()->user()->username])->with('success', 'Proyecto actualizado exitosamente.');
    }

    // destroy
    public function destroy($user, Project $project)
    {
        // Eliminar el registro de "pays" asociado al proyecto
        $pay = Pay::where('project_id', $project->id)->first();
        if ($pay) {
            $pay->delete();
        }

        $project->delete();

        return redirect()->route('projects.index', ['user' => auth()->user()->username])->with('success', 'Proyecto eliminado exitosamente.');
    }
}
