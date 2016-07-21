<?php

class ValidationHelper
{
    /**
     * The rules for new profile
     *
     * @var array
     */
    public static $userRegisterRules = array(
       'name'=>'required|alpha_spaces|min:2',
       'gender'=>'required',
       'email'=>'required|email|unique:users',
       'primary_number'=>'required',
       'birthdate'=>'required|date',
       'password'=>'required|alpha_num|between:6,64|confirmed',
       'password_confirmation'=>'required|alpha_num|between:6,64'
    );

    /**
     * The rules for change password
     *
     * @var array
     */
    public static $changePasswordRules = array(
       'current_password'=>'required|alpha_num|between:6,64',
       'password'=>'required|alpha_num|between:6,64|confirmed',
       'password_confirmation'=>'required|alpha_num|between:6,64'
    );

    /**
     * The rules for edit profile
     *
     * @var array
     */
    public static $profileEditRules = array(
       'name'=>'required|alpha_spaces|min:2',
       'father_name'=>'alpha_spaces|min:2', 'mother_name'=>'alpha_spaces|min:2',
       'birthdate' => 'date', 'photo'=>'image'
       //'birthtime'=> array('regex:/^([01]?[0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9]|60)$/')
    );

    /**
     * The rules for adding new trustee (admin operation)
     *
     * @var array
     */
    public static $addTrusteeRules = array(
       'name'=>'required|alpha_spaces|min:2',
       'email'=>'required|email|unique:users',
       'password'=>'required|alpha_num|between:6,64|confirmed',
       'password_confirmation'=>'required|alpha_num|between:6,64'
    );
}