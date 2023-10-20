@extends('layouts.app')

@section('title')
    Editar Proyecto
@endsection

@section('content')
<div class="md:flex md:justify-center md:gap-10 md:items-center">
    <div class="md:w-6/12 p-5">
        <img src="{{ asset('img/register.jpg') }}" alt="Imagen registro">
    </div>
    <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
        @auth
        <form action="{{ route('projects.update', ['user' => auth()->user()->username, 'project' => $project]) }}" method="POST" novalidate>
            @csrf
            @method('PATCH')

            {{-- Nombre --}}
            <div class="mb-5">
                <label for="name" class="mb-2 block uppercase text-gray-500 font-bold">
                    Nombre:
                </label>
                <input
                    id="name"
                    name="name"
                    type="text"
                    placeholder="Nombre del Proyecto"
                    class="border p-3 w-full rounded-lg @error('name')
                        border-red-500
                    @enderror"
                    value="{{ $project->name }}"
                />
                @error('name')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Ubicación --}}
            <div class="mb-5">
                <label for="location" class="mb-2 block uppercase text-gray-500 font-bold">
                    Ubicación:
                </label>
                <input
                    id="location"
                    name="location"
                    type="text"
                    placeholder="Ubicación del Proyecto"
                    class="border p-3 w-full rounded-lg @error('location')
                        border-red-500
                    @enderror"
                    value="{{ $project->location }}"
                />
                @error('location')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Fecha de Inicio --}}
            <div class="mb-5">
                <label for="start_date" class="mb-2 block uppercase text-gray-500 font-bold">
                    Fecha de Inicio:
                </label>
                <input
                    id="start_date"
                    name="start_date"
                    type="date"
                    class="border p-3 w-full rounded-lg @error('start_date')
                        border-red-500
                    @enderror"
                    value="{{ $project->start_date }}"
                />
                @error('start_date')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Fecha de Finalización --}}
            <div class="mb-5">
                <label for="finish_date" class="mb-2 block uppercase text-gray-500 font-bold">
                    Fecha de Finalización:
                </label>
                <input
                    id="finish_date"
                    name="finish_date"
                    type="date"
                    class="border p-3 w-full rounded-lg @error('finish_date')
                        border-red-500
                    @enderror"
                    value="{{ $project->finish_date }}"
                />
                @error('finish_date')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Costo --}}
            <div class="mb-5">
                <label for="cost" class="mb-2 block uppercase text-gray-500 font-bold">
                    Costo:
                </label>
                <input
                    id="cost"
                    name="cost"
                    type="number"
                    placeholder="Costo del Proyecto"
                    class="border p-3 w-full rounded-lg @error('cost')
                        border-red-500
                    @enderror"
                    value="{{ $project->cost }}"
                />
                @error('cost')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Propietario del Proyecto --}}
            <div class="mb-5">
                <label for="user_id" class="mb-2 block uppercase text-gray-500 font-bold">
                    Propietario del Proyecto:
                </label>
                <select
                    id="user_id"
                    name="user_id"
                    class="border p-3 w-full rounded-lg @error('user_id') border-red-500 @enderror"
                >
                    <option value="">Selecciona un usuario</option>
                    @foreach ($users as $id => $name)
                        <option
                        value="{{ $id }}"
                        @if ($id == $project->user_id)
                            selected
                        @endif
                        >
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
                @error('user_id')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            @auth
                <input type="hidden" name="user" value="{{ auth()->user()->username }}">
            @endauth

            {{-- Monto --}}
            <div class="mb-5">
                <label for="amount" class="mb-2 block uppercase text-gray-500 font-bold">
                    Monto:
                </label>
                <input
                    id="amount"
                    name="amount"
                    type="number"
                    placeholder="Monto del Proyecto"
                    class="border p-3 w-full rounded-lg @error('amount')
                        border-red-500
                    @enderror"
                    value="{{ old('amount', $pay->amount ?? null) }}"
                />
                @error('amount')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <input type="submit" value="Actualizar Proyecto" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full text-white rounded-lg">
        </form>
        @endauth
    </div>
</div>
@endsection
