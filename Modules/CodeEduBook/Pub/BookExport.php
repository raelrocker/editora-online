<?php
 namespace CodeEduBook\Pub;
 
 use CodeEduBook\Models\Book;
 use CodeEduBook\Repositories\ChapterRepository;
 use CodeEduBook\Criteria\FindByBook;
 use CodeEduBook\Criteria\OrderByOrder;
 
 class BookExport
 {

    /**
     * @var ChapterRepository
     */
    private $chapterRepository;

    public function __construct(ChapterRepository $chapterRepository) {
         $this->chapterRepository = $chapterRepository;
    }
     
     public function export(Book $book)
     {
        $chapters = $this->chapterRepository
            ->pushCriteria(new FindByBook($book->id))
            ->pushCriteria(new OrderByOrder($book->id))
            ->all();
        
        $this->exportContents($book, $chapters);
        file_put_contents("{$book->contents_storage}/dedication.md", $book->dedication);
     }
     
     protected function exportContents(Book $book, $chapters)
     {
         if (!is_dir($book->contents_storage)) {
             mkdir($book->contents_storage, 0775, true);
         }
         
         foreach ($chapters as $chapter) {
             file_put_contents("{$book->contents_storage}/{$chapter->order}.md", $chapter->content);
         }
     }
 }