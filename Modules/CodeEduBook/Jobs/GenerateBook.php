<?php

namespace CodeEduBook\Jobs;

use CodeEduBook\Pub\BookExport;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Bus\Queueable;
use CodeEduBook\Models\Book;

class GenerateBook implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels, Queueable;
    /**
     * @var Book
     */
    private $book;

    /**
     * Create a new job instance.
     *
     * @param Book $book
     */
    public function __construct(Book $book)
    {
        //
        $this->book = $book;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(BookExport $bookExport)
    {
        $easyBookCmd = "easybook/book publish --dir={$this->book->disk} {$this->book->id} ";

        $bookExport->export($this->book);


        exec("php " . base_path("$easyBookCmd print"));
        exec("php " . base_path("$easyBookCmd kindle"));
        exec("php " . base_path("$easyBookCmd ebook"));
        $bookExport->compress($this->book);
    }
}
