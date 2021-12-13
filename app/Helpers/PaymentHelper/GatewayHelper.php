<?php

namespace App\Helpers\PaymentHelper;

use App\Helpers\Helper;

class GatewayHelper extends Helper
{
    protected $store_id;
    protected $store_secret;

    public function __construct()
    {
        $this->store_id = config('payment-gateway.store.id');
        $this->store_secret = config('payment-gateway.store.secret');
    }

    public function getStoreID()
    {
        return $this->store_id;
    }

    public function getStoreSecret()
    {
        return $this->store_secret;
    }
}