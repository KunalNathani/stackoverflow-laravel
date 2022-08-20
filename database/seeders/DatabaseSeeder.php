<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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

        User::factory(10)->create()->each(function($user) {
            for($i=1; $i<=random_int(2, 8); ++$i) {
                $user->questions()->create(Question::factory()->make()->toArray());
            }
        });
    }
}
