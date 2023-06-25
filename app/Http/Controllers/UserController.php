<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class UserController extends Controller
{
    /**
     * @param Request $request
     * @param UserController $user
     * @return RedirectResponse|Application|Redirector|\Illuminate\Foundation\Application
     */

    public function index()
    {
        $users = User::orderBy('id')->get();

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:2'],
            'surname' => ['required', 'min:2'],
            'age' => ['required', 'numeric', 'min:0', 'max: 120'],
            'email' => ['required', 'string', 'email', 'unique:users,email'],
        ]);
        $user = new User();

        $user->name = $request['name'];
        $user->surname = $request['surname'];
        $user->age = $request['age'];
        $user->email = $request['email'];
        $user->password = 123;

        $user->save();

        return redirect(route('users.index'))->with('success', 'User created successfully.');
        ;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function show(User $user): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|Application
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User $user
     * @return Application|\Illuminate\Foundation\Application|Redirector|RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        $request = $request->validate([
            'name' => ['required', 'min:2'],
            'surname' => ['required', 'min:2'],
            'age' => ['required', 'numeric', 'min:0', 'max: 120'],
        ]);

        $user->name = $request['name'];
        $user->surname = $request['surname'];
        $user->age = $request['age'];

        $user->save();

        return redirect(route('users.index'))->with('success', 'User updated successfully.');
        ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        User::destroy($user->id);

        return redirect(route('users.index'))->with('success', 'User deleted successfully.');
        ;
    }
}
