<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

// load home at root
Route::get('/', array('as' => 'home', function()
{
    return Redirect::to('/login');
}));

// routes for login and signup
Route::get('/login', 'UserController@showLogin');
Route::post('/login', 'UserController@doLogin');
Route::get('/logout', 'UserController@doLogout');
Route::get('/register', 'UserController@showRegister');
Route::post('/register', 'UserController@doRegister');

// password reset
Route::controller('password', 'RemindersController');

// all routes after logging in
Route::group(array('before' => 'auth'), function()
{
    Route::pattern('id', '[0-9]+');

    Route::get('/home', function()
    {
        return Redirect::to('/profiles');
    });

    Route::get('/profiles/{id}/edit', function($id)
    {
        $user = User::find($id);
        $loggedUser = Auth::user();

        // allow only if user is either admin or its own profile
        if ($loggedUser->isAdmin() || $id == $loggedUser->id)
        {
            return View::make('vivah.profile-edit', array('profile' => $user,
                                                          'user' => $loggedUser));
        }
        return Response::view('layouts/error',
            array('message' => 'Unauthorized to update this profile'), 403);
    });

    //TODO: Add {id} here
    Route::put('/profiles/edit', array('as' => 'profile.edit',
                                       'uses' => 'UserController@editProfile'));

    Route::get('/profiles', 'UserController@showProfiles');

    Route::get('/profiles/{id}', 'UserController@getProfile');

    Route::get('/changepassword', function()
    {
        return View::make('vivah.change-password', array('user' => Auth::user()));
    });

    Route::post('/changepassword', 'UserController@changePassword');

    // admin operations, filtered via admin
    Route::get('/admin/profiles', 'AdminController@showProfiles');
    Route::put('/admin/profiles/{id}/status', 'AdminController@changeStatus');
});
