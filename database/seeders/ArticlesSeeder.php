<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Articles;
use Illuminate\Database\Seeder;

class ArticlesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = Categories::factory(5)->create() ;

        User::factory(10)->create()->each(function ($user) use ($categories) {
            Articles::factory(rand(1,3))->create([
                'user_id' => $user->id,
                'categories_id' => ($categories->random(1)->first())->id
            ]);
        });
    }
}
