<?php

namespace App\Helpers\PaymentHelper;

use App\Helpers\Helper;
use Str;
use GuzzleHttp\Client;
use App\Models\CoursePurchase;

class Initiator extends Helper
{
    protected $gateway_initiation_data = [];
    protected $course;
    protected $purchase;
    protected $gateway;
    public $request;
    public $status;

    public function __construct($user, $course)
    {
        $this->user = $user;
        $this->course = $course;
        $this->request = request();
        $this->configInitiationData();
        $this->createCoursePurchase();
        $this->initiateGateway();
    }

    public function configInitiationData()
    {
        $this->setStoreData();
        $this->setPriceData();
        $this->setMetaData();
        $this->setCustomerData();
        $this->setProductData();
        $this->setShippingData();
    }

    public function setStoreData()
    {
        $this->gateway_initiation_data['store_id'] = config('payment-gateway.store.id');
        $this->gateway_initiation_data['store_passwd'] = config('payment-gateway.store.secret');
    }

    public function setPriceData()
    {
        $this->gateway_initiation_data['total_amount'] = str_replace(',', '', $this->course->price);
        $this->gateway_initiation_data['currency'] = $this->course->currency;
        $this->gateway_initiation_data['tran_id'] = $this->generateRandomTranxID();
        $this->gateway_initiation_data['emi_option'] = 0;
    }

    public function setMetaData()
    {
        $this->gateway_initiation_data['success_url'] = $this->request->phone;
        $this->gateway_initiation_data['fail_url'] = $this->request->phone;
        $this->gateway_initiation_data['cancel_url'] = $this->request->phone;
        // $this->gateway_initiation_data['ipn_url'] = $this->request->phone;
    }

    public function generateRandomTranxID()
    {
        $txid = time() . Str::random(20);

        while (!is_null(CoursePurchase::where('txid', $txid)->first())) {
            $txid = time() . Str::random(20);
        }

        return $txid;
    }

    public function setCustomerData()
    {
        $this->gateway_initiation_data['cus_name'] = $this->user['name'];
        $this->gateway_initiation_data['cus_email'] = $this->user['email'];
        $this->gateway_initiation_data['cus_phone'] = $this->user['phone'];
        $this->gateway_initiation_data['cus_add1'] = "blank";
        $this->gateway_initiation_data['cus_city'] = "blank";
        $this->gateway_initiation_data['cus_postcode'] = "blank";
        $this->gateway_initiation_data['cus_country'] = "blank";
    }

    public function setProductData()
    {
        $this->gateway_initiation_data['product_category'] = "Online Course";
        $this->gateway_initiation_data['product_name'] = $this->course->name;
        $this->gateway_initiation_data['product_profile'] = "non-physical-goods";
    }

    public function setShippingData()
    {
        $this->gateway_initiation_data['shipping_method'] = "NO";
        $this->gateway_initiation_data['num_of_item'] = 1;
    }

    public function createCoursePurchase()
    {
        $purchase = [
            'course_id' => $this->course->id,
            'txid' => $this->gateway_initiation_data['tran_id'],
            'status' => "Pending",
            'price' => $this->gateway_initiation_data['total_amount'],
            'currency' => $this->gateway_initiation_data['currency'],
        ];

        if (!is_null(auth()->user())) {
            $purchase['user_id'] = $this->user['id'];
        } else {
            $purchase['user_data'] = json_encode($this->user);
        }

        $this->purchase = CoursePurchase::create($purchase);
    }

    public function initiateGateway()
    {
        $client = new Client(['verify' => false]);
        $response = $client->request(
            'POST',
            config('payment-gateway.api.initiate'),
            ['form_params' => $this->gateway_initiation_data]
        );

        $this->gateway = json_decode((string)$response->getBody());
        $this->checkGatewayStatus();
    }

    public function checkGatewayStatus()
    {
        if ($this->gateway->status == "SUCCESS") {
            $this->purchase->status = "Processing";
            $this->purchase->session_id = $this->gateway->sessionkey;
            $this->setStatusToTrue('Proceeding to payment gateway', redirect($this->gateway->redirectGatewayURL));
        } else {
            $this->purchase->status = "Failed to initiate: " . $this->gateway->failedreason;
            $this->setStatusToFalse("Failed to initiate: " . $this->gateway->failedreason, redirect()->route('course.show', ['course' => $this->course->id]));
        }

        $this->purchase->save();
    }

    public function setStatusToFalse($message, $redirect)
    {
        $this->status = [
            'success' => false,
            'redirect' => $redirect,
            'message' => $message
        ];
    }

    public function setStatusToTrue($message, $redirect = false)
    {
        $this->status = [
            'success' => true,
            'redirect' => $redirect,
            'message' => $message
        ];
    }
}