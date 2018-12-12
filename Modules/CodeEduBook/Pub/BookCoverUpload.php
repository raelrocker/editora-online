<?php
 namespace CodeEduBook\Pub;
 
 use CodeEduBook\Models\Book;
 use Illuminate\Http\UploadedFile;
 
 class BookCoverUpload
 {
     public function upload(Book $book, UploadedFile $cover)
     {
        \Storage::disk(config('codeedubook.book_storage'))
                ->putFileAs($book->ebook_template, $cover, $book->cover_ebook_name);
        
        $this->makeCoverPdf($book);
     }
     
     protected function makeCoverPdf(Book $book)
     {
         if (!is_dir($book->pdf_template_storage)) {
             mkdir($book->pdf_template_storage, 0775, true);
         }
         
         $img = new \Imagick($book->cover_ebook_file);
         $img->setimageformat('pdf');
         
         $img->writeimage($book->cover_pdf_file);
     }
 }