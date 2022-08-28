<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Answer;
use App\Models\Question;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        User::factory(10)->create()->each(function ($user) {
            $user->questions()
                ->saveMany(Question::factory(random_int(2, 8))->make())
                ->each(function ($question) {
                    $question->answers()->saveMany(Answer::factory(random_int(5, 10))->make());
                });
        });
    }
}
