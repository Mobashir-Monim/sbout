<?php

namespace App\Helpers\CourseHelper;

use App\Helpers\Helper;
use App\Models\Course;

class SearchHelper extends Helper
{
    protected $courses;
    protected $name;
    protected $type;
    protected $per_page;
    protected $options = [
        'default' => '<option>Offered to</option>',
        0 => '<option value="0">BracU Students</option>',
        1 => '<option value="1">Non-BracU Students</option>',
        2 => '<option value="2">Both</option>'
    ];

    public function __construct()
    {
        $this->name = request()->name;
        $this->type = request()->type;

        $this->filterByName();
        $this->filterByType();
    }

    public function filterByName()
    {
        $this->name = $this->name == null ? "" : $this->name;

        $this->courses = Course::where('name', 'like', "%" . $this->name . "%");
    }

    public function filterByType()
    {
        if ($this->type != "" && $this->type != null && $this->type <= 2 && $this->type >= 0) {
            $this->courses->where('offered_to', $this->type);
        }
    }

    public function getCourses()
    {
        return $this->courses->orderBy('created_at', 'DESC')->paginate(12)->withQueryString();
    }

    public function getTypeList()
    {
        $list = '';
        $order = ['default', 0, 1, 2];

        if ($this->type == 0 && !is_null($this->type)) {
            $order = [0, 1, 2];
        } elseif ($this->type == 1) {
            $order = [1, 0, 2];
        } elseif ($this->type == 2) {
            $order = [2, 0, 1];
        }

        foreach ($order as $option)
            $list = $list . $this->options[$option];

        return $list;
    }
}