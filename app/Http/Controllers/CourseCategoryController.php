<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CourseCategory;


class CourseCategoryController extends Controller
{
    public function index()
    {
        return view('course-category.index', [
            'categories' => CourseCategory::orderBy('created_at', 'desc')->paginate('10')
        ]);
    }

    public function create()
    {
        return view('course-category.create');
    }
}
