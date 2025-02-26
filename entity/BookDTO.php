<?php 

class BookDTO {
    public readonly Book $book;
    public string $author;
    public string $illustrator;

    public function __construct(Book $book, string $author, string $illustrator) {
        $this->book = $book;
        $this->author = $author;
        $this->illustrator = $illustrator;
    }
}