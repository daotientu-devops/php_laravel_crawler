<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use MongoClient;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function connect()
    {
        // Connect to mongodb
        $m = new MongoClient();

        // select a database
        $db = $m->crawler;

        return $db;
    }

    public function connectOthers()
    {
        // Connect to mongodb
        $m = new MongoClient();

        return $m;
    }
}
