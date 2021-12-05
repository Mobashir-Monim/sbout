<?php

namespace App\Helpers\CourseHelper;

use App\Helpers\Helper;
use App\Models\Course;
use App\Helpers\Utilities\Uploaders\ImageUploader;

class Creator extends Helper
{
    protected $course;
    protected $request;

    public function __construct()
    {
        $this->request = request();
        $this->stripRequestValues();
        $this->createCourse();
    }

    public function stripRequestValues()
    {
        // dd($this->request->price);
        $this->course = [
            'name' => $this->request->name,
            'details' => $this->request->details,
            'price' => $this->request->price,
            'currency' => $this->request->currency,
            'provider' => $this->request->provider,
            'provider_abbreviation' => $this->request->provider_abbreviation,
            'offered_to' => $this->request->offered_to,
            'description' => $this->request->description,
            'short' => $this->request->short,
            'thumbnail' => $this->storeCourseImage()
        ];
    }

    public function storeCourseImage()
    {
        if ($this->request->hasFile('thumbnail')) {
            $uploader = new ImageUploader('thumbnail', 'uploads/courses/thumbnails', config('filesystems.default'));

            return $uploader->getImagePath();
        }

        return null;
    }

    public function createCourse()
    {
        $this->course = Course::create($this->course);
    }

    public function getCourse()
    {
        return $this->course;
    }
}