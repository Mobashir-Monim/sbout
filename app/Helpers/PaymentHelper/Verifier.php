<?php

namespace App\Helpers\PaymentHelper;

use App\Helpers\Helper;

class Verifier extends GatewayHelper
{
    protected $course;
    protected $purchase;
    protected $request;
    protected $verify_array;

    public function __construct($course, $purchase)
    {
        parent::__construct();
        $this->course = $course;
        $this->purchase = $purchase;
        $this->request = request();
    }

    public function generateVerificationArray()
    {
        $verify_array = array_intersect_key($this->request->all(), array_fill_keys(explode(',', $this->request->verify_key), ""));
        $verify_array['store_passwd'] = md5($this->getStoreSecret());
        ksort($verify_array);

        return $verify_array;
    }

    public function generateVerificationSign()
    {
        $verify_array = $this->generateVerificationArray();

        return md5(implode('&', array_map(function($key, $value) {
            return "$key=$value";
        }, array_keys($verify_array), $verify_array)));
    }

    public function verifySign()
    {
        return $this->request->verify_sign == $this->generateVerificationSign();
    }
}