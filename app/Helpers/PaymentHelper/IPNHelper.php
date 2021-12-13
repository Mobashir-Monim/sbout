<?php

namespace App\Helpers\PaymentHelper;

use App\Helpers\Helper;

class IPNHelper extends GatewayHelper
{
    protected $course;
    protected $purchase;
    protected $ipn_data;

    public function __construct($course, $purchase)
    {
        parent::__construct();
        $this->course = $course;
        $this->purchase = $purchase;
        $this->ipn_data = request()->all();
    }

    public function storeIPNData()
    {
        $this->purchase->ipn_data = $this->ipn_data;
    }

    public function updatePurchaseStatus()
    {
        $this->purchase->status = $this->ipn_data->status;
    }
}