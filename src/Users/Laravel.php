<?php

namespace HappyDemon\UsrLastly\Users;


use Illuminate\Support\Facades\Auth;
use HappyDemon\UsrLastly\User;

class Laravel implements User {

    public function getUser()
    {
        return (Auth::check()) ? Auth::user() : false;
    }
}