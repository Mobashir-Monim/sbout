<?php

namespace App\Helpers\PaymentHelper;

use App\Helpers\Helper;
use App\Models\User;
use App\Jobs\SSO\RequestAccount;
use App\Jobs\LMS\EnrollStudent;

class NotificationHelper extends GatewayHelper
{
    protected $course;
    protected $purchase;
    protected $payment_data;
    protected $process_status;
    protected $payment_success;
    protected $message;
    protected $success = false;

    public function __construct($course, $purchase)
    {
        parent::__construct();
        $this->course = $course;
        $this->purchase = $purchase;
        $this->payment_data = request()->all();
        
        try {
            $this->payment_success = $this->payment_data['status'] == 'VALID' || $this->payment_data['status'] == 'VALIDATED';
            $this->processNotification();
        } catch (\Throwable $th) {
            $this->message = "Incorrect request";
        }
    }

    public function processNotification()
    {
        if ($this->willProcessNotification()) {
            $this->success = true;
            $this->updatePurchase();
            $this->setStatusMessage();

            if ($this->payment_success) {
                if ($this->payment_data['risk_level'] == 0) 
                    dispatch(new EnrollStudent($this->fetchStudent(), $this->course));
            }
        }
    }

    public function willProcessNotification()
    {
        if (!$this->purchase->is_completed) {
            if ($this->verifyPaymentData()) {
                if ($this->validatePaymentData()) {
                    $this->checkRiskStatus();
                    
                    return true;
                }
            }
        }

        return false;
    }

    public function verifyPaymentData()
    {
        if ((new Verifier($this->course, $this->purchase))->verifySign())
            return true;

        $this->setNotificationMessage('Enrollment on hold due to: Verification Failed');
            
        return false;
    }

    public function validatePaymentData()
    {
        if ($this->payment_data['status'] == 'VALID' || $this->payment_data['status'] == 'VALIDATED') {
            if ((new Validator($this->course, $this->purchase, $this->payment_data['val_id']))->validate())
                return true;

            $this->setNotificationMessage('Enrollment on hold due to: Validation Failed');

            return false;
        }

        return true;
    }

    public function checkRiskStatus()
    {
        if ($this->payment_success) {
            if ($this->payment_data['risk_level'] != 0)
                $this->setNotificationMessage("Enrollment on hold due to: Transaction Verification", true);
        }
    }

    public function getMessageTitle()
    {
        if ($this->payment_data['status'] == 'VALID' || $this->payment_data['status'] == 'VALIDATED')
            return 'Enrollment on hold';

        return 'Enrollment cancelled';
    }

    public function setNotificationMessage($message, $update_flag = false)
    {
        $this->message = $message;

        if ($update_flag) {
            $this->purchase->flag = $message;
            $this->purchase->save();
        }
    }

    public function updatePurchase()
    {
        $this->purchase->tx_data = $this->payment_data;
        $this->purchase->status = $this->payment_data['status'];
        $this->purchase->is_completed = true;
        $this->purchase->save();
    }

    public function fetchStudent()
    {
        if (is_null($this->purchase->user_id))
            return $this->createUser();

        return $this->purchase->user;
    }

    public function createUser()
    {
        $user = $this->purchase->user_data;
        $user['password'] = bcrypt('');
        $user = User::create($user);
        $this->updatePurchaseUser($user);

        dispatch(new RequestAccount($user));

        return $user;
    }

    public function updatePurchaseUser($user)
    {
        $this->purchase->user_id = $user->id;
        $this->purchase->save();
    }

    public function setStatusMessage()
    {
        if ($this->payment_data['status'] == 'VALID' || $this->payment_data['status'] == 'VALIDATED') {
            $this->setNotificationMessage("Please check your email for further instructions");
        } elseif ($this->payment_data['status'] == 'FAILED') {
            $this->setNotificationMessage("Purchase failed due to: " . $this->payment_data['error']);
        } elseif ($this->payment_data['status'] == 'CANCELLED') {
            $this->setNotificationMessage("Purchase failed due to cancellation");
        } elseif ($this->payment_data['status'] == 'UNATTEMPTED') {
            $this->setNotificationMessage("Purchase failed due to not being attempted");
        } elseif ($this->payment_data['status'] == 'EXPIRED') {
            $this->setNotificationMessage("Purchase failed due to gateway expiration");
        } else {
            $this->setNotificationMessage("Unknown Status");
        }
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function getSuccessStatus()
    {
        return $this->success;
    }
}