<?php

use Illuminate\Database\Seeder;
use CodeEduBook\Models\Book;
use CodeEduBook\Models\Chapter;

class ChaptersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $books = Book::all();
        foreach ($books as $book) {
            factory(Chapter::class, 5)->make()->each(function($chapter) use ($book) {
                $chapter->book_id = $book->id;
                $chapter->save();
            });
        }
    }
}
