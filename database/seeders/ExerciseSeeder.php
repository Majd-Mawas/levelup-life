<?php

namespace Database\Seeders;

use App\Models\Exercise;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ExerciseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $exercises = [
            [
                'name' => 'Squat',
                'description' => 'A compound exercise that targets the quadriceps, hamstrings, and glutes.',
                'image' => 'public/images/exercises/squat.jpg'
            ],
            [
                'name' => 'Bench Press',
                'description' => 'A compound exercise that targets the chest, shoulders, and triceps.',
                'image' => 'public/images/exercises/bench-press.jpg'
            ],
            [
                'name' => 'Deadlift',
                'description' => 'A compound exercise that targets the back, glutes, and hamstrings.',
                'image' => 'public/images/exercises/deadlift.jpg'
            ],
            [
                'name' => 'Triceps Push Down',
                'description' => 'An isolation exercise that targets the triceps.',
                'image' => 'public/images/exercises/triceps-pushdown.jpg'
            ],
            [
                'name' => 'Hip Thrust',
                'description' => 'A compound exercise that primarily targets the glutes.',
                'image' => 'public/images/exercises/hip-thrust.jpg'
            ],
            [
                'name' => 'Stretching',
                'description' => 'Various stretching exercises to improve flexibility and reduce muscle tension.',
                'image' => 'public/images/exercises/stretching.jpg'
            ],
        ];

        foreach ($exercises as $exerciseData) {
            $exercise = Exercise::create([
                'name' => $exerciseData['name'],
                'description' => $exerciseData['description'],
            ]);

            // Add image if it exists in the public directory
            $imagePath = $exerciseData['image'];
            if (File::exists(public_path($imagePath))) {
                $exercise->addMedia(public_path($imagePath))
                    ->preservingOriginal()
                    ->toMediaCollection('exercise_image');
            }
        }
    }
}
