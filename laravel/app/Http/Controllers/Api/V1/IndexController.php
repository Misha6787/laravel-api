<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\VersionResource;
use App\Models\User;

class IndexController extends Controller
{
    public function index() {
        return 2;
    }

    public function test() {
        return New VersionResource(User::all());
    }
}
