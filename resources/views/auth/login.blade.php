@extends('layouts.app')

@section('title')
    Iniciar Sesión
@endsection

@section('content')
<div class="md:flex md:justify-center md:gap-10 md:items-center">
    <div class="md:w-6/12 p-5">
        <img src="{{ asset('img/login.jpg') }}" alt="Imagen registro">
    </div>
    <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
        <form method="POST" action="{{ route('login') }}"  novalidate>
            @csrf

            @if(session('status'))
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2">
                    {{ session('status') }}
                </p>
            @endif
            {{-- Email --}}
            <div class="mb-5">
                <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                    Email:
                </label>
                <input
                    id="email"
                    name="email"
                    type="text"
                    placeholder="Email"
                    class="border p-3 w-full rounded-lg @error('email')
                        border-red-500
                    @enderror"
                    value="{{ old('name') }}"
                />

                @error('email')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Password --}}
            <div class="mb-5">
                <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                    Password:
                </label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    placeholder="Password de Registro"
                    class="border p-3 w-full rounded-lg @error('password')
                        border-red-500
                    @enderror"
                />

                @error('password')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="mb-5">
                <input type="checkbox" name="remember">
                <label class="text-gray-500 text-sm">Mantener mi sesión abierta</label>
            </div>

            {{-- Submit --}}
            <input type="submit" value="Iniciar Sesión" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full text-white rounded-lg">
        </form>
    </div>
</div>
@endsection
