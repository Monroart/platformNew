<?php

namespace Database\Factories;

use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

class HomeWorkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'text' => $this->faker->text,
            'subject_id' => Subject::query()->inRandomOrder()->first(),
            'image_path' => '/storage/teacher_homework_images/img.png'
        ];
    }
}
