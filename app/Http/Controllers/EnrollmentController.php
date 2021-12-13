<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Helpers\EnrollmentHelper\Register;
use App\Helpers\UserHelper\Updator as UserUpdator;

class EnrollmentController extends Controller
{
    public function registration(Course $course)
    {
        return view('enrollment.registration', [
            'course' => $course
        ]);
    }

    public function register(Course $course, Request $request)
    {
        $user = ['name' => $request->name, 'email' => $request->email, 'phone' => $request->phone];

        if (!is_null(auth()->user())) {
            (new UserUpdator(auth()->user()))->updatePhone($request->phone);
            $user = auth()->user();
        }

        $helper = new Register($user, $course);
        
        if (!$helper->status['success'])
            flash($helper->status['message'])->error();

        return $helper->status['redirect'];
    }
}
