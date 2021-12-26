<?php

namespace App\Helpers\Utilities\API;

use App\Helpers\Helper;
use Carbon\Carbon;
use GuzzleHttp\Client;

class Authenticator extends Helper
{
    protected $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function getAccessToken()
    {
        if ($this->isAccessTokenValid())
            return $this->config->variable['access_token']['token'];

        if ($this->config->variable['description']['access_type'] == 'simple_oauth')
            return $this->getTokenWithSimpleOAuth();

        return $this->getTokenWithZeroKnowledgeOAuth();
    }

    public function isAccessTokenValid()
    {
        if (!array_key_exists('access_token', $this->config->variable)) {
            $variable = $this->config->variable;
            $variable['access_token'] = [
                'token' => null,
                'issued_at' => null,
                'expires_at' => null,
            ];
            $this->config->variable = $variable;
            $this->config->save();
        }

        $iat = $this->config->variable['access_token']['issued_at'];
        $xat = $this->config->variable['access_token']['expires_at'];

        if (!is_null($iat) && Carbon::parse($iat)->diffInDays(Carbon::now(), false) > -7) {
            if (!is_null($xat) && !is_null($this->config->variable['access_token']['token']))
                return Carbon::parse($xat) > Carbon::now();
        }

        return false;
    }

    public function getTokenWithSimpleOAuth()
    {
        return $this->recordAccessToken($this->callEndpoint(
            $this->config->variable['description']['token_endpoint'],
            [
                "client_id" => $this->getClientID(),
                "client_secret" => $this->getClientSecret(),
                "grant_type" => "client_credentials"
            ]
        ));
    }

    public function getTokenWithZeroKnowledgeOAuth()
    {
        $auth_response = $this->requestForAuthentication();

        return $this->recordAccessToken(
            $this->completeZeroKnowledgeChallenge($auth_response['challenge_set'])
        );
    }

    public function callEndpoint($endpoint, $endpoint_data)
    {
        $client = new Client(['verify' => true]);
        $response = $client->request('POST', $endpoint, ['form_params' => $endpoint_data]);
    
        return json_decode((string)$response->getBody(), true);
    }

    public function requestForAuthentication()
    {
        return $this->callEndpoint(
            $this->config->variable['description']['auth_challenge_endpoint'],
            [
                "client_id" => $this->getClientID(),
                "grant_type" => "trustless_client_credentials"
            ]
        );
    }

    public function completeZeroKnowledgeChallenge($challenge_set)
    {
        $request_params = [
            "client_id" => $this->getClientID(),
            "grant_type" => "trustless_token",
            "solution" => []
        ];

        foreach ($challenge_set as $value) {
            $request_params['solution'][] = hash('sha256', json_encode([
                'client_secret' => $this->getClientSecret(),
                'challenge_value' => $value
            ]));
        }

        return $this->callEndpoint(
            $this->config->variable['description']['token_challenge_endpoint'],
            $request_params
        );
    }

    public function recordAccessToken($response)
    {
        $variable = $this->config->variable;
        $variable['access_token'] = [
            'token' => $response['access_token'],
            'expires_at' => Carbon::now()->addSeconds($response['expires_in'] - 30),
        ];
        $this->config->variable = $variable;
        $this->config->save();

        return $response['access_token'];
    }

    public function getClientID()
    {
        return $this->config->variable['credentials']['client_id'];
    }

    public function getClientSecret()
    {
        return $this->config->variable['credentials']['client_secret'];
    }
}