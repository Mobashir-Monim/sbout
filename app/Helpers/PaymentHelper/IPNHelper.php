<?php

namespace App\Helpers\PaymentHelper;

use App\Helpers\Helper;
use App\Models\User;
use App\Jobs\SSO\RequestAccount;

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

    public function processNotification()
    {
        if (!$this->purchase->is_completed && (new Verifier($this->course, $this->purchase))->verifySign()) {
            $this->updatePurchase();

            if ($this->ipn_data->status == 'VALID') {
                if (is_null($this->purchase->user_id))
                    $this->createUser();
            }
        }
    }

    public function updatePurchase()
    {
        $this->purchase->ipn_data = $this->ipn_data;
        $this->purchase->status = $this->ipn_data->status;
        $this->purchase->is_completed = true;
        $this->purchase->save();
    }

    public function createUser()
    {
        $user = json_decode($this->purchase->user_data, true);
        $user['password'] = bcrypt('');
        $user = User::create($user);
        dispatch(new RequestAccount($user));
    }
}