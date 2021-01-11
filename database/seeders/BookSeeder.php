<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use Carbon\Carbon;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cover1 = base64_encode(file_get_contents(storage_path('app/public/SpiderMan.jpg')));
        $cover2 = base64_encode(file_get_contents(storage_path('app/public/MobyDick.jpg')));

        Book::create([
            "name"=>"Spider-Man",
            "cover"=>"data:image/jpeg;base64,".$cover1,
            "author"=>"Stan Lee",
            "publication" => "1962-08",
            "status"=>false,
            "borrow_user"=> "Jessica Saenz",
            "categories_id"=> 2
        ]);

        Book::create([
            "name"=>"Moby Dick",
            "cover"=>"data:image/jpeg;base64,".$cover2,
            "author"=>"Herman Melville",
            "publication"=> "1851-10-18",
            "status"=>true,
            "categories_id"=> 1
        ]);
    }
}
