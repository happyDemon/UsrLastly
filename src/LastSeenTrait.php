<?php

namespace HappyDemon\UsrLastly;

trait LastSeenTrait {

    /**
     * @return mixed
     */
    public function lastly()
    {
        return $this->hasOne('HappyDemon\UsrLastly\Time', 'user_id');
    }

    public function getLastSeenAttribute()
    {
        return app('UsrLastlyRepository')
            ->retrieve($this);
    }
} 
