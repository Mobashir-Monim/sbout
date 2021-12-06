<?php

namespace App\Helpers\UserHelper;

use App\Helpers\Helper;
use App\Models\User;

class Updator extends Helper
{
    protected $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function updateName($name)
    {
        if ($name != $this->user->name) {
            $this->user->name = $name;
            $this->user->save();
        }
    }

    public function updatePhone($phone)
    {
        if ($this->user->phone != $phone) {
            $this->user->phone = $phone;
            $this->user->save();
        }
    }
}