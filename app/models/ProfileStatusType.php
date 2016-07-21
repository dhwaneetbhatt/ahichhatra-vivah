<?php

class ProfileStatusType extends Eloquent
{
    // profile status type constants
    const _NEW = 'NEW';
    const INCOMPLETE = 'INCOMPLETE';
    const EDITED = 'EDITED';
    const APPROVED = 'APPROVED';
    const DISAPPROVED = 'DISAPPROVED';
    const DELETED = 'DELETED';

    protected $table = 'profile_status_types';
}