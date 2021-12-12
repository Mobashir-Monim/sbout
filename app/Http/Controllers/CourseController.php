<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Helpers\CourseHelper\Creator;
use App\Helpers\CourseHelper\SearchHelper;

class CourseController extends Controller
{
    public function index()
    {
        $helper = new SearchHelper;

        return view('course.index', [
            'courses' => $helper->getCourses(),
            'list' => $helper->getTypeList(),
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
