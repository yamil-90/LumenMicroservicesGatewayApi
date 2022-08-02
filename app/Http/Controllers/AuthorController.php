<?php

namespace App\Http\Controllers;

use App\Services\AuthorService;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class AuthorController extends Controller
{
    use ApiResponser;

    public $authorService;

    /**
     * Returns the controller instance
     */

    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }
    /**
     * returns all the authors
     *
     * @return void
     */
    public function index()
    {
        return $this->successResponse($this->authorService->getAllAuthors());
    }

    /**
     * returns all the authors
     *
     * @return void
     */
    public function show($author)
    {
        return $this->successResponse($this->authorService->showAuthor($author));
    }
    /**
     * returns all the authors
     *
     * @return void
     */
    public function store(Request $request)
    {
        return $this->successResponse(
            $this->authorService->createAuthor(
                $request->all(), 
                Response::HTTP_CREATED)
        );
    }

    /**
     * returns all the authors
     *
     * @return void
     */
    public function update(Request $request, $author)
    {
        return $this->successResponse(
            $this->authorService->editAuthor(
                $request->all(),
                $author
            ));
    }

    /**
     * removes the author
     *
     * @return void
     */
    public function destroy($author)
    {
        return $this->successResponse(
            $this->authorService->destroyAuthor(
                $author
            )
            );
    }


}
