@extends('layouts.auth-master')

@section('content')
    <form method="post" class="flex flex-col items-center justify-center h-screen" action="{{ route('login.perform') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <h1 class="text-2xl font-semibold mb-4">Login</h1>
        <div class="mb-4 flex flex-col items-center">
            <input type="text" class="w-64 px-4 py-2 rounded-lg border focus:outline-none focus:ring-2 focus:ring-blue-500" name="username" value="{{ old('username') }}" placeholder="Username" required autofocus>
            @if ($errors->has('username'))
                <span class="text-red-500">{{ $errors->first('username') }}</span>
            @endif
        </div>
        <div class="mb-4 flex flex-col items-center">
            <input type="password" class="w-64 px-4 py-2 rounded-lg border focus:outline-none focus:ring-2 focus:ring-blue-500" name="password" value="{{ old('password') }}" placeholder="Password" required>
            @if ($errors->has('password'))
                <span class="text-red-500">{{ $errors->first('password') }}</span>
            @endif
        </div>
        <div class="form-group mb-3">
            <label for="remember">Stay logged in</label>
            <input type="checkbox" name="remember">
        </div>
        <button class="px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500" type="submit">Login</button>
    </form>
@endsection
