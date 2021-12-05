<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use Str;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= rand(50,100); $i++) {
            Course::create([
                'name' => "Course $i",
                'price' => rand(0, 10000),
                'currency' => ['USD', 'BDT'][rand(0,1)],
                'offered_to' => rand(0,2),
                'provider' => Str::random(rand(50,254)),
                'provider_abbreviation' => Str::random(rand(3,8)),
                'short' => Str::random(rand(50,254)),
                'description' => Str::random(rand(500,25400))
            ]);
        }
    }
}
