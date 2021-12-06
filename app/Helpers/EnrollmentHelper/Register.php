<?php

namespace App\Helpers\EnrollmentHelper;

use App\Helpers\Helper;
use App\Models\User;
use App\Helpers\PaymentHelper\Initiator;

class Register extends Helper
{
    protected $user;
    protected $course;
    protected $initiator;
    public $status;

    public function __construct($user, $course)
    {
        $this->user = $user;
        $this->course = $course;
        
        if ($this->checkIfAccountExists()) {
            if ($this->checkUserOrg()) {
                $this->initiator = new Initiator($user, $course);
                $this->status = $this->initiator->status;
            }
        }
    }

    public function checkIfAccountExists()
    {
        if (is_null(auth()->user())) {
            if (!is_null(User::where('email', $this->user['email'])->first())) {
                $this->setStatusToFalse('Account already exists, please login and then enroll', redirect()->route('login'));

                return false;
            }
        } else {
            $this->user = auth()->user();
            $this->user = [
                'name' => $this->user->name,
                'email' => $this->user->email,
                'id' => $this->user->id,
                'phone' => $this->user->phone
            ];
        }

        $this->setStatusToTrue('Beginning payment initiation');

        return true;
    }

    public function checkUserOrg()
    {
        if (($this->course->offered_to == 0 && !endsWith($this->user['email'], '@g.bracu.ac.bd')) || ($this->course->offered_to == 1 && endsWith($this->user['email'], '@g.bracu.ac.bd'))) {
            $this->setStatusToFalse('This course is not available for everyone to enroll', redirect()->route('course.show', ['course' => $this->course->id]));
            
            return false;
        }

        $this->setStatusToTrue('Beginning payment initiation');

        return true;
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