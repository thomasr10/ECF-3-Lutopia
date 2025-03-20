<?php

class BookResa {
    public Book $book;
    public Age $age;
    public Type $type;
    public string $author;
    public int $count_borrow;

    public function __construct(Book $book, Age $age, Type $type, string $author, int $count_borrow) {
        $this->book = $book;
        $this->age = $age;
        $this->type = $type;
        $this->author = $author;
        $this->count_borrow = $count_borrow;
    }
}