<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class SwaggerMiddleware extends Controller
{
    /**
     * Handle swagger requests
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * 
     * @return ResponseInterface
     */
    public function handle(
        Request $request,
        Response $response,
    ) {
        return view('swagger');
    }

    public function schema(Request $request, Response $response): Response
    {

        $newResponse = $response->withHeader('Content-Type', 'application/x-yaml');
        $newResponse->getBody()->write(file_get_contents(base_path() . '/public/openapi.yaml'));

        return $newResponse;
    }
}
