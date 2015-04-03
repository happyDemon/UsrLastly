<?php

namespace HappyDemon\UsrLastly\Repositories;


use Carbon\Carbon;
use Illuminate\Http\Request;
use HappyDemon\UsrLastly\Repository;
use Illuminate\Support\Facades\Redis as Storage;

class Redis extends Repository
{
    /**
     * @var Storage
     */
    protected $storage = NULL;

    // Register the storage
    public function __construct()
    {
        $this->storage = Storage::connection();
    }

    public function store($user, Request $request)
    {
        $meta = $this->prepareMeta($request);

        // No need to store the full Carbon object
        $meta['date'] = $meta['date']->toDateTimeString();

        $this->storage
            ->set('usr.' . $user->getKey() . '.lastSeen',
                json_encode($meta, JSON_FORCE_OBJECT));
    }

    public function retrieve($user)
    {
        $data = json_decode($this->storage->get('usr.' . $user->getKey() . '.lastSeen'));

         // Make the stored date into Carbon object
        if ($data)
        {
            $data->date = Carbon::createFromFormat('Y-m-d H:i:s', $data->date);

            return $data;
        }
        $data = json_decode('{"date":""}');
        $data->date = Carbon::now();
        return $data;
    }
}