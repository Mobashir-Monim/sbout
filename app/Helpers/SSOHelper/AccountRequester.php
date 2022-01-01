<?php

namespace App\Helpers\SSOHelper;

use App\Helpers\Helper;
use GuzzleHttp\Client;

class AccountRequester extends Helper
{
    protected $user;
    protected $authenticator;
    protected $client;
    protected $params;
    protected $status;

    public function __construct($user)
    {
        $this->user = $user;
        $this->authenticator = new Authenticator;
        $this->requestAccount();
    }


    public function requestAccount()
    {
        $client = new Client(['verify' => true]);
        $response = null;

        try {
            $response = $client->request('POST', $this->getRequestEndPoint(), [
                'headers' => $this->getRequestHeaders(),
                'form_params' => $this->getFormParams()
            ]);
        } catch (\Throwable $th) {
            if ($th->getCode() != 409)
                $this->setStatusToFalse($th->getMessage());
        }

        $this->setStatusToTrue("Successful");
    }

    public function getRequestEndPoint()
    {
        return $this->authenticator->getSSOConfig()->variable['description']['endpoints']['user.create']['endpoint'];
    }

    public function getRequestHeaders()
    {
        return [
            "Authorization" => "Bearer " . $this->authenticator->getAccessToken(),
            "Accept" => "application/json"
        ];
    }

    public function getFormParams()
    {
        return [
            'name' => $this->user->name,
            'email' => $this->user->email,
            'system_role' => "system-user"
        ];
    }

    public function setStatusToFalse($message)
    {
        $this->status = [
            'success' => false,
            'message' => $message
        ];
    }

    public function setStatusToTrue($message)
    {
        $this->status = [
            'success' => true,
            'message' => $message
        ];
    }

    public function getStatus()
    {
        return $this->status;
    }
}