<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface
{

    use UserTrait, RemindableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password');

    /**
     * Fields that can be mass-updated
     *
     * @var array
     */
    protected $fillable = array(
        'name', 'father_name', 'mother_name', 'birthdate', 'birthplace',
        'birthtime', 'height', 'current_city', 'gotra', 'vatan', 'nadi',
        'nakshtra', 'rashi', 'permanent_address', 'primary_number',
        'education', 'hobbies', 'job_description', 'salary', 'secondary_address',
        'secondary_number', 'references'
    );

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Get the remember token for the user.
     *
     * @return string
     */
    public function getRememberToken()
    {
        return $this->remember_token;
    }

    /**
     * Set the remember token for the user.
     */
    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    /**
     * Get the name of the field
     * 
     * @return string
     */
    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    /**
     * Role for the user
     *
     * @return string
     */
    public function role()
    {
        return $this->hasOne('Role', 'id', 'role_id');
    }


    /**
     * Status type for the user
     *
     * @return string
     */
    public function status()
    {
        return $this->hasOne('ProfileStatusType', 'id', 'status_type_id');
    }

    /**
     * @return true, if user has admin role
     */
    public function isAdmin()
    {
        return $this->role_id == Role::where('name', 'admin')->pluck('id');
    }

    /**
     * @return true, if user is allowed to login
     */
    public function canLogin()
    {
        $allowedRoles =
            array(ProfileStatusType::where('name', ProfileStatusType::_NEW)->pluck('id'),
                  ProfileStatusType::where('name', ProfileStatusType::DISAPPROVED)->pluck('id'),
                  ProfileStatusType::where('name', ProfileStatusType::DELETED)->pluck('id'));
        return !in_array($this->status_type_id, $allowedRoles);
    }

    /**
     * @return true, if user's profile is approved
     */
    public function isApproved()
    {
        return $this->status_type_id == ProfileStatusType::where('name', ProfileStatusType::APPROVED)->pluck('id');
    }
}