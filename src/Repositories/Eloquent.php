<?php

namespace HappyDemon\UsrLastly\Repositories;


use Illuminate\Http\Request;
use HappyDemon\UsrLastly\Repository;
use HappyDemon\UsrLastly\Time;

class Eloquent extends Repository
{
    public function store($user, Request $request)
    {
        $meta = $this->prepareMeta($request);

        $last_seen = $user->lastly ?: new Time();

        $last_seen->date = $meta['date'];
        $last_seen->request = $meta['request'];

        $user->lastly()->save($last_seen);
    }

    public function retrieve($user)
    {
        return $user->lastly ? new Time();
    }
}
