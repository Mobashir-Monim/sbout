<?php

namespace App\Helpers\SSOHelper;

use App\Helpers\Helper;
use App\Helpers\Utilities\API\Authenticator as APIAuthenticator;
use App\Models\Config;

class Authenticator extends APIAuthenticator
{
    protected $sso;
    protected $token;

    public function __construct()
    {
        parent::__construct($this->getSSOConfig());
        $this->token = parent::getAccessToken();
    }

    public function getSSOConfig()
    {
        if (is_null($this->sso)) {
            $this->sso = Config::where('name', 'sso')->first();
        }

        return $this->sso;
    }

    public function getAccessToken()
    {
        return $this->token;
    }
}