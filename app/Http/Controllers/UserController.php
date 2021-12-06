<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Helpers\UserHelper\Creator;
use App\Helpers\UserHelper\Udpator;

class UserController extends Controller
{
    public function update(User $user, Request $request)
    {
        $updator = new Updator($user);
        $updator->updatePhone($request->phone);
        $updator->updateName($request->phone);
    }

    public function changePassword(User $user)
    {

    }
}
