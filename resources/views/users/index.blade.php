<!DOCTYPE html>
@include('common.alert')
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css" rel="stylesheet">
    <title>Users Table</title>
</head>
<body>
<div class="container mx-auto py-8">
    @guest
        <div class="relative">
            <div class="absolute top-0 right-0 mt-4 mr-4">
                <div class="flex">
                    <form action="{{route('login.perform')}}" method="get">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <button type="submit" class="flex items-center gap-1 text-blue-600 hover:text-blue-900 border border-blue-500 rounded px-3 py-1">
                            <span class="text-sm font-medium">Login</span>
                        </button>
                    </form>
                    <form action="{{route('register.perform')}}" method="get">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <button type="submit" class="flex items-center gap-1 text-blue-600 hover:text-blue-900 border border-blue-500 rounded px-3 py-1 ml-4">
                            <span class="text-sm font-medium">Register</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endguest
    @auth
            <div class="relative">
                <div class="absolute top-0 right-0 mt-4 mr-4">
                    <div class="flex">
                        <a href="{{route('admin')}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <button type="submit" class="flex items-center gap-1 text-blue-600 hover:text-blue-900 border border-blue-500 rounded px-3 py-1">
                                Admin</button>
                        </a>
                        <a href="{{route('logout.perform')}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <button type="submit" class="flex items-center gap-1 text-blue-600 hover:text-blue-900 border border-blue-500 rounded px-3 py-1 ml-4">
                            Logout</button>
                        </a>
                    </div>
                </div>
            </div>
    @endauth
    <h1 class="text-3xl font-bold mb-4">Users Table</h1>
    <a href="{{route('users.create')}}"><button class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-20">Add new user</button></a>
    <div class="grid grid-cols-3 gap-4">
        @foreach($users as $user)
            <div class="bg-gray-200 p-4">
                <h2 class="text-lg font-semibold">User {{$user->id}}</h2>
                <p>{{$user->name}} {{$user->surname}}</p>
                <a href="{{route('users.show', $user)}}"><button class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">View</button></a>
            </div>
        @endforeach
    </div>
</div>
</body>
</html>
