<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Helpers\EnrollmentHelper\Register;

class EnrollmentController extends Controller
{
    public function registration(Course $course)
    {
        if (!is_null(auth()->user()))
            return redirect()->route('enrollment.register', ['course' => $course]);

        return view('enrollment.registration', [
            'course' => $course
        ]);
    }

    public function register(Course $course, Request $request)
    {
        $user = is_null(auth()->user()) ? ['name' => $request->name, 'email' => $request->email, 'phone' => $request->phone] : auth()->user();

        $helper = new Register($user, $course);
        
        if (!$helper->status) {
            flash($helper->status['message'])->error();
        }

        return $helper->status['redirect'];
    }

    public function enrollmentSucceeded(Course $course, Request $request)
    {
        
    }

    public function enrollmentFailed(Course $course, Request $request)
    {

    }

    public function enrollmentCancelled(Course $course, Request $request)
    {

    }
}
