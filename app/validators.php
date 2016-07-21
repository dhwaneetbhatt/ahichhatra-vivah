<?php

/*
|--------------------------------------------------------------------------
| Custom Validator
|--------------------------------------------------------------------------
|
| Defines custom validation rules for HTML forms
|
*/

Validator::extend('alpha_spaces', function($attribute, $value)
{
    return preg_match('/^[\pL\s]+$/u', $value);
});