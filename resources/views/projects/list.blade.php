@extends('layouts.app')

@section('title')
    Lista de Proyectos
@endsection


@section('content')
    <div class="container mx-auto mt-6 p-6">
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombres</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Apellido</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Año de Nacimiento</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dirección</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Propietario</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Monto</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $project->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $project->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $project->location }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $project->start_date }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $project->finish_date }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $project->cost }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($project->user)
                                    {{ $project->user->name }}
                                @else
                                    Propietario no asignado
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($project->pays->isNotEmpty())
                                    @foreach ($project->pays as $pay)
                                        {{ $pay->amount }}
                                        <br>
                                    @endforeach
                                @else
                                    Sin pagos
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">

                                <a href="{{ route('projects.edit', ['user' => auth()->user()->username, 'project' => $project]) }}" class="text-blue-500">
                                    <button class="px-3 py-1 bg-blue-500 text-white rounded-full hover:bg-blue-600">Editar</button>
                                </a>

                                <form action="{{ route('projects.destroy', ['user' => auth()->user()->username, 'project' => $project]) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded-full hover:bg-red-600">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
