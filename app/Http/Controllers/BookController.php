<?php

namespace App\Http\Controllers;

use App\Services\AuthorService;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Services\BookService;
use Illuminate\Http\Response;

class BookController extends Controller
{
    use ApiResponser;

    public $bookService;

    public $authorService;

    /**
     * Returns the controller instance
     */

    public function __construct(BookService $bookService, AuthorService $authorService)
    {
        $this->bookService = $bookService;
        $this->authorService = $authorService;
    }
    /**
     * returns all the books
     *
     * @return void
     */
/**
     * returns all the books
     *
     * @return void
     */
    public function index()
    {
        return $this->successResponse($this->bookService->getAllBooks());
    }

    /**
     * returns all the books
     *
     * @return void
     */
    public function show($book)
    {
        return $this->successResponse($this->bookService->showBook($book));
    }
    /**
     * returns all the books
     *
     * @return void
     */
    public function store(Request $request)
    {
        $this->authorService->showAuthor($request->author_id);
        return $this->successResponse(
            $this->bookService->createBook(
                $request->all(), 
                Response::HTTP_CREATED)
        );
    }

    /**
     * returns all the books
     *
     * @return void
     */
    public function update(Request $request, $book)
    {
        return $this->successResponse(
            $this->bookService->editBook(
                $request->all(),
                $book
            ));
    }

    /**
     * removes the book
     *
     * @return void
     */
    public function destroy($book)
    {
        return $this->successResponse(
            $this->bookService->destroyBook(
                $book
            )
            );
    }


}
