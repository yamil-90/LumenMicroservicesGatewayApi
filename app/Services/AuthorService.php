<?php

namespace App\Services;

use App\Traits\ConsumeExternalService;
use Illuminate\Support\Facades\Log;

class AuthorService
{
    use ConsumeExternalService;

    public $baseUri;

    public $secret;

    public function __construct()
    {
        $this->baseUri = config('services.authors.base_uri');
        $this->secret = config('services.authors.secret');
    } 
    /**
     * gets all authors from the author
     *
     * @return string
     */
    public function getAllAuthors()
    {
        return $this->performRequest('GET', '/authors');
    }
    
    /**
     * CREATES ONE AUTHOR
     *
     * @param [type] $data
     * @return void
     */
    public function createAuthor($data)
    { 
        return $this->performRequest('POST', '/authors', $data);
    }
    
    /**
     * shows one author
     *
     * @param [type] $author
     * @return void
     */
    public function showAuthor($author)
    {
        return $this->performRequest('GET', "/authors/{$author}");

    }

    /**
     * edits one author
     *
     * @param [type] $data
     * @param [type] $author
     * @return void
     */
    public function editAuthor($data, $author)
    {
        return $this->performRequest('PATCH', "/authors/{$author}", $data);
    }

    public function destroyAuthor($author)
    {
        return $this->performRequest('DELETE', "/authors/{$author}");
    }
}