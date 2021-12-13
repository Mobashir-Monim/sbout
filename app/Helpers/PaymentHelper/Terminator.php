<?php

namespace App\Helpers\PaymentHelper;

use App\Helpers\Helper;

class Terminator extends GatewayHelper
{
    public $request;

    public function __construct($course, $purchase)
    {
        parent::__construct();
        $this->request = request();
    }

    public function updatePurchaseStatus()
    {

    }
}