<?php

namespace HappyDemon\UsrLastly;


use Illuminate\Database\Eloquent\Model;

class Time extends Model {

    public $timestamps = false;

    protected $table = 'user_last_seen';

    // The request column is stored as an array
    protected $casts = [
        'request' => 'array',
    ];

    // Make sure the date column gets parsed into a Carbon object
    public function getDates()
    {
        return ['date'];
    }

    // This model belongs to a user
    public function user()
    {
        return $this->belongsTo(get_class(app('UsrLastlyUser')->getUser()));
    }
} 