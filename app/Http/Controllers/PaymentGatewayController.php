<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CoursePurchase;
use App\Helpers\PaymentHelper\Verifier;
use App\Helpers\PaymentHelper\NotificationHelper;

class PaymentGatewayController extends Controller
{
    public function storeIPN(Course $course, CoursePurchase $purchase, Request $request)
    {
        $notifier = new NotificationHelper($course, $purchase);

        return $notifier->getSuccessStatus();
    }

    public function enrollmentSucceedful(Course $course, CoursePurchase $purchase, Request $request)
    {
        $notifier = new NotificationHelper($course, $purchase);

        return view('enrollment.messages.successful', [
            'course' => $course,
            'message' => $notifier->getMessage()
        ]);
    }

    public function enrollmentUnsuccessful(Course $course, CoursePurchase $purchase, Request $request)
    {
        $notifier = new NotificationHelper($course, $purchase);
        
        return view('enrollment.messages.unsuccessful', [
            'course' => $course,
            'message' => $notifier->getMessage()
        ]);
    }
}
