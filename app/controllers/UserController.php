<?php

/**
 * This controller handles the User model and related pages
 */
class UserController extends BaseController
{
    protected $layout = "layouts.master";

    /**
     * Method for returning the login view
     */
    public function showLogin()
    {
        if (Auth::check())
        {
            return Redirect::to('/home');
        }
        $this->layout->content = View::make('vivah.login');
    }

    /**
     * Method for handling login attempt
     */
    public function doLogin()
    {
        $user = array(
            'email' => Input::get('email'),
            'password' => Input::get('password')
        );

        if (Auth::attempt($user))
        {
            $user = Auth::user();
            if ($user->canLogin())
            {
                return Redirect::to('/home');
            }
            else
            {
                // not allowed until admin approves it
                Auth::logout();
                return Redirect::back()
                       ->with('message',
                              'Your registration is not yet approved. '.
                              'Please contact Administrator for approval.')
                       ->withInput();
            }
        }
        else
        {
            // authentication failure! lets go back to the login page
            return Redirect::back()
                   ->with('message', 'Your username or password is incorrect')
                   ->withInput();
        }
    }

    /**
     * Logout
     */
    public function doLogout()
    {
        Auth::logout();
        return Redirect::to('/login');
    }

    /**
     * Returns the signup form
     */
    public function showRegister()
    {
        if (Auth::check())
        {
            return Redirect::to('/home');
        }
        $this->layout->content = View::make('vivah.register');
    }

    /**
     * Method for handling user registration
     */
    public function doRegister()
    {
        $validator = Validator::make(Input::all(), ValidationHelper::$userRegisterRules);
        if ($validator->passes())
        {
            $user = new User;

            $gender = Input::get('gender');
            $user->role_id = Role::where('name', 'user:' . $gender)->pluck('id');

            $user->name = Input::get('name');
            $user->email = Input::get('email');
            $user->primary_number = Input::get('primary_number');
            $user->birthdate = Input::get('birthdate');
            $user->password = Hash::make(Input::get('password'));

            // set default profile picture
            $user->photo = '/images/profile_photos/default_' . $gender . '.png';

            $user->save();
            return Redirect::to('/login')
                   ->with('success',
                    'Registered succesfully. You will be able to login when '.
                    'admin approves your profile.');
        }
        else
        {
            return Redirect::back()
                   ->with('message', 'The following errors occurred')
                   ->withErrors($validator)->withInput();
        }
    }

    /**
    * Change the password of the user
    */
    public function changePassword()
    {
        $validator = Validator::make(Input::all(), ValidationHelper::$changePasswordRules);
        if ($validator->passes())
        {
            $currentPassword = Input::get('current_password');
            $user = Auth::user();

            // error if current passwords do not match
            if (strlen($currentPassword) > 0 && !Hash::check($currentPassword, $user->password))
            {
                return Redirect::back()
                       ->with('message', 'Current password does not match');
            }

            // update password
            $user->password = Hash::make(Input::get('password'));
            $user->save();

            return Redirect::back()
                   ->with('success', 'Password changed succesfully');
        }
        else
        {
            return Redirect::back()
                   ->with('message', 'The following errors occurred')
                   ->withErrors($validator)->withInput();
        }
    }

    /**
     * Edit the profile information
     * @return edit-profile view
     */
    public function editProfile()
    {
        $user = User::find(Input::get('id'));
        $loggedUser = Auth::user();

        // disallow edits of other profiles
        if ($loggedUser->isAdmin() || $user->id == $loggedUser->id)
        {
            $validator = Validator::make(Input::all(), ValidationHelper::$profileEditRules);
            if ($validator->passes())
            {
                // updating image if exists
                if (Input::hasFile('photo'))
                {
                    $destination = '/data/profile_photos';
                    $filename = 'photo_' . $user->id . '.' .
                                strtolower(Input::file('photo')->getClientOriginalExtension());
                    Input::file('photo')->move($destination, $filename);
                    $user->photo = '/images/profile_photos/' . $filename;
                }

                // if admin is making changes, no need for approval.
                // if user is approved, make profile edited, else keep as-is.
                if ($user->isApproved() && !$loggedUser->isAdmin())
                {
                    $user->status_type_id =
                        ProfileStatusType::where('name', ProfileStatusType::EDITED)->pluck('id');
                }

                // updating user information
                $user->update(Input::all());

                return Redirect::back()
                        ->with('success', 'Profile Saved. '.
                               'It Will be visible after approval.');
            }
            else
            {
                return Redirect::back()
                       ->with('message', 'The following errors occurred')
                       ->withErrors($validator)->withInput();
            }
        }
        return Response::view('layouts/error',
            array('message' => 'Unauthorized to update this profile'), 403);
    }

    /**
     * Loads and shows all profiles
     * @return profiles view
     */
    public function showProfiles()
    {
        $id = Auth::user()->id;
        $user = User::find($id);

        if($user->isApproved())
        {
            $page = Input::get('page', 1);

            // form query conditions based on logged in user
            $query = DB::table('users')
                        ->where('status_type_id',
                                ProfileStatusType::where('name', ProfileStatusType::APPROVED)->pluck('id'));

            $role = Role::find($user->role_id)->name;
            if (strcmp($role, 'user:male') == 0)
            {
                $query->where('role_id',
                              Role::where('name', 'user:female')->first()->id);
            }
            else if (strcmp($role, 'user:female') == 0)
            {
                $query->where('role_id',
                              Role::where('name', 'user:male')->first()->id);
            }

            // do not include admin
            $query->where('role_id', '<>',
                          Role::where('name', 'admin')->first()->id);

            $users = $query->paginate(20);

            return View::make('vivah.profiles', array('profiles' => $users,
                                                      'user' => $user));
        }
        else
        {
            return Redirect::to('/profiles/'.$user->id.'/edit/')
                    ->with('message', 'Please complete your profile.
                                       You will be able to see other
                                       profiles once your profile is
                                       complete and approved.');
        }
    }

    /**
     * Get the profile of the user
     * @param  $id unique integer identifier of profile
     */
    public function getProfile($id)
    {
        $user = User::find($id);

        $loggedUser = Auth::user();

        // disallow same gender views
        if ($user->role_id == $loggedUser->role_id)
        {
            if ($id <> $loggedUser->id)
            {
                return Response::view('layouts/error',
                    array('message' => 'Unauthorized to view this profile'), 403);
            }
        }

        // simple properties to be displayed in the view
        $properties = array(
            'father_name' => 'Father\'s Name', 'mother_name' => 'Mother\'s Name',
            'birthplace' => 'Place of Birth', 'height' => 'Height',
            'current_city' => 'Current City', 'gotra' => 'ગોત્ર', 'vatan' => 'વતન',
            'rashi' => 'રાશી', 'nadi' => 'નાડી', 'nakshtra' => 'નક્ષત્ર',
            'email' => 'Email', 'primary_number' => 'Mobile/Phone Number',
            'permanent_address' => 'Permanent Address',
            'education' => 'Educational Qualification',
            'hobbies' => 'Hobbies', 'job_description' => 'Job Description',
            'salary' => 'Salary', 'secondary_address' => 'Office/Other Address',
            'secondary_number' => 'Office/Other Number'
        );

        return View::make('vivah/profile-info', array('profile' => $user,
                                                      'properties' => $properties,
                                                      'user' => $loggedUser));
    }
}
