<?php

namespace App\Helpers\PaymentHelper;

use App\Helpers\Helper;
use GuzzleHttp\Client;

class Validator extends GatewayHelper
{
    protected $course;
    protected $purchase;
    protected $payment_data;
    protected $notification_data;
    protected $validation_data;

    public function __construct($course, $purchase, $val_id)
    {
        parent::__construct();
        $this->course = $course;
        $this->purchase = $purchase;
        $this->notification_data = request()->all();
        $this->validation_data = $this->getValidationData($val_id);
        
        if (is_null($this->purchase->validation_data)) {
            $this->purchase->validation_data = $this->validation_data;
            $this->purchase->save();
        }
    }

    public function generateValidationURL($val_id)
    {
        return config('payment-gateway.api.validate') .
            "?val_id=" . $val_id .
            "&store_id=" . $this->getStoreID() .
            "&store_passwd=" . $this->getStoreSecret() .
            "&store_passwd=" . $this->getStoreSecret() .
            "&v=1&format=json";
    }

    public function getValidationData($val_id)
    {
        $client = new Client(['verify' => config('payment-gateway.store.https')]);
        $response = $client->request('GET', $this->generateValidationURL($val_id));

        return json_decode((string)$response->getBody(), true);
    }

    public function validate($data = ['validation_data', 'notification_data'])
    {
        if (!is_array($data))
            $data = [$data];

        $flag = true;

        foreach ($data as $type) {
            $flag &= $this->validateTransactionAmount($type);
            $flag &= $this->validateTransactionCurrency($type);
        }

        return $flag;
    }

    public function validateTransactionAmount($data)
    {
        $amount = $this->$data['amount'];

        if ($this->purchase->currency != $this->$data['currency']) {
            if ($amount > str_replace(',', '', $this->purchase->price)) {
                $amount = $amount / $this->$data['currency_rate'];
            } else {
                $amount = $amount * $this->$data['currency_rate'];
            }
        }

        return abs($amount - str_replace(',', '', $this->purchase->price)) < 1;
    }

    public function validateTransactionCurrency($data)
    {
        return $this->purchase->currency == $this->$data['currency_type'];
    }
}