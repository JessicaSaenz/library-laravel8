<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //factory(Category::class, 10)->create();
        Category::create([
            "name" => "Classics",
            "description"=> "Classics"
        ]);
        Category::create([
            "name" => "Comic Book",
            "description"=> "Comic Book"
        ]);
    }
}
