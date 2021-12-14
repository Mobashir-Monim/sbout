<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CoursePurchase;
use App\Helpers\PaymentHelper\Verifier;
use App\Helper\PaymentHelper\IPNHelper;

class PaymentGatewayController extends Controller
{
    public function storeIPN(Course $course, CoursePurchase $purchase, Request $request)
    {
        $helper = new IPNHelper($course, $purchase);
    }

    public function enrollmentSucceedful(Course $course, CoursePurchase $purchase, Request $request)
    {
        $verifier = new Verifier($course, $purchase);

        dd($verifier->verifySign());
        return view('enrollment.messages.successful', [
            'course' => $course
        ]);
    }

    public function enrollmentUnsuccessful(Course $course, CoursePurchase $purchase, Request $request)
    {
        dd($request->all(), $course, $purchase, $request['val_id']);
        return view('enrollment.messages.unsuccessful', [
            'course' => $course
        ]);
    }
}
