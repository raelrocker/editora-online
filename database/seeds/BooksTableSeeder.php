<?php

use CodeEduBook\Jobs\GenerateBook;
use Illuminate\Database\Seeder;
use CodeEduBook\Models\Book;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = \CodeEduBook\Models\Category::all();
        $bookUpload = app(\CodeEduBook\Pub\BookCoverUpload::class);
        $books = factory(Book::class, 20)
            ->create()
            ->each(function ($book) use ($categories, $bookUpload) {
                $categoriesRandom = $categories->random(4);
                $book->categories()->sync($categoriesRandom->pluck('id')->all());
                $thumbFileName = "l" . rand(1, 5) . ".png";
                $thumbFile = new \Illuminate\Http\UploadedFile(
                    storage_path("app/files/faker/thumbs/$thumbFileName"),
                    $thumbFileName
                );
                $bookUpload->upload($book, $thumbFile);
            });
        \File::copyDirectory(storage_path('app/books/template'), storage_path('app/template'));
        \File::deleteDirectory(storage_path('app/books'));
        \File::copyDirectory(storage_path('app/template'), storage_path('app/books/template'));
        \File::deleteDirectory(storage_path('app/template'));
        $books->slice(0, 5)->each(function ($book) {
            try {
                \Notification::shouldReceive('send')->never();
                $job = (new GenerateBook($book->user, $book))->onConnection('sync');
                dispatch($job);
            } catch(Exception $e) {}
        });
    }
}
