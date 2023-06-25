<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::group(['namespace' => 'App\Http\Controllers'], function() {

    Route::get('/', function () {
        return redirect('users');
    })->name('home');

    Route::get('/users', function () {
        return view('users');
    })->name('users.index');

    Route::resource('/users', UserController::class);

    Route::get('/error-404', function () {
        abort(404);
    })->name('error-404');

    Route::get('/error-500', function () {
        abort(500);
    })->name('error-500');

    Route::group(['middleware' => ['guest']], function() {
        Route::get('/register', 'RegisterController@show')->name('register.show');
        Route::post('/register', 'RegisterController@register')->name('register.perform');

        Route::get('/login', 'LoginController@show')->name('login.show');
        Route::post('/login', 'LoginController@login')->name('login.perform');

    });

    Route::group(['middleware' => ['auth']], function() {
        Route::get('/admin', function () {
            return view('admin');
        })->name('admin');

        Route::post('/admin', function (\Illuminate\Http\Request $request) {
            $credentials = $request->validate([
                'password' => 'required|min:8|confirmed',
            ]);
            $user = Auth::user();

            $user->password = $credentials['password'];

            $user->save();

            return redirect('/users');
        })->name('admin.password');

        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
    });
});

