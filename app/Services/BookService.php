<?php

namespace App\Services;

use App\Traits\ConsumeExternalService;

class BookService
{
    use ConsumeExternalService;

    public $baseUri;

    public $secret;

    public function __construct()
    {
        $this->baseUri = config('services.books.base_uri');
        $this->secret = config('services.books.secret');
    } 
    /**
     * gets all books from the book
     *
     * @return string
     */
    public function getAllBooks()
    {
        return $this->performRequest('GET', '/books');
    }
    
    /**
     * CREATES ONE book
     *
     * @param [type] $data
     * @return void
     */
    public function createBook($data)
    { 
        return $this->performRequest('POST', '/books', $data);
    }
    
    /**
     * shows one book
     *
     * @param [type] $book
     * @return void
     */
    public function showBook($book)
    {
        return $this->performRequest('GET', "/books/{$book}");

    }

    /**
     * edits one book
     *
     * @param [type] $data
     * @param [type] $book
     * @return void
     */
    public function editBook($data, $book)
    {
        return $this->performRequest('PATCH', "/books/{$book}", $data);
    }

    public function destroyBook($book)
    {
        return $this->performRequest('DELETE', "/books/{$book}");
    }
}