<?php

namespace App\Controllers;

use App\Models\Book;

class BooksController extends BaseController {

    public static function index () {
        $books = Book::booksWithData();
        
        self::loadView('/books', [
            'title' => 'Books',
            'books'=> $books,
        ]);
    }

}