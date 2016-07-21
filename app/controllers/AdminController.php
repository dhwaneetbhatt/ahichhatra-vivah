<?php

/**
 * This controller handles the User model and admin related pages
 */
class AdminController extends BaseController
{

    /**
    * Show the profiles as per the filter
    */
    public function showProfiles()
    {
        $status = Input::get('status');
        $users = User::where(
                    'status_type_id',
                    ProfileStatusType::where('name', $status)->pluck('id'))
                ->paginate(5);
        return View::make('vivah.approve-profiles', array('profiles' => $users,
                                                          'user' => Auth::user(),
                                                          'status' => $status));
    }

    /**
    * Approve the profile indicated by the id
    */
    public function changeStatus($id)
    {
        $status = Input::get('status');
        $user = User::find($id);
        if ($status == 'PURGE')
        {
            // if user has a custom photo, delete the photo physically
            $idx = strrpos($user->photo, '/');
            $filename = substr($user->photo, $idx+1);
            if (strpos($filename, 'default') === false)
            {
                $photosDir = getenv('AHICHHATRA_IMAGE_STORAGE_DIR');
                $fullPath = $photosDir . '/' . $filename;
                log::info('User ' . $user->email . ' has uploaded custom photo at ' .
                          $fullPath . ', deleting the file.');
                unlink($fullPath);
            }
            // purge entry from the database
            $user->delete();
        }
        else
        {
            $user->status_type_id = ProfileStatusType::where('name', $status)->pluck('id');
            $user->save();
        }
    }
}