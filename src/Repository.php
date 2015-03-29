<?php

namespace HappyDemon\UsrLastly;


use Illuminate\Http\Request;
use Carbon\Carbon;

abstract class Repository {

    protected function prepareMeta(Request $request)
    {
        return [
            'date' => Carbon::now(),
            'request' => [
                'uri' => $request->path(),
                'params' => $request->route()->parametersWithoutNulls(),
                'method' => $request->method()
            ]
        ];
    }

    abstract public function store($user, Request $request);

    abstract public function retrieve($user);
} 