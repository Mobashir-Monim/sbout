<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Helpers\CourseHelper\Creator;

class CourseController extends Controller
{
    public function index()
    {
        return view('course.index', [
            'courses' => Course::orderBy('created_at', 'desc')->paginate('12')
        ]);
    }

    public function create()
    {
        return view('course.create');
    }

    public function store(Request $request)
    {
        $course = (new Creator)->getCourse();

        return redirect()->route('course.show', [
            'course' => $course->id
        ]);
    }

    public function show(Course $course)
    {
        return view('course.show', [
            'course' => $course
        ]);
    }
}
