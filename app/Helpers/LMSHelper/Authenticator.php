<?php

namespace App\Helpers\LMSHelper;

use App\Helpers\Helper;
use App\Helpers\Utilities\API\Authenticator as APIAuthenticator;
use App\Models\Config;

class Authenticator extends APIAuthenticator
{
    protected $lms;
    protected $token;

    public function __construct()
    {
        parent::__construct($this->getLMSConfig());
        $this->token = parent::getAccessToken();
    }

    public function getLMSConfig()
    {
        if (is_null($this->lms)) {
            $this->lms = Config::where('name', 'lms')->first();
        }

        return $this->lms;
    }

    public function getAccessToken()
    {
        return $this->token;
    }
}