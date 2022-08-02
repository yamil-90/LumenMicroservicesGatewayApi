<?php

namespace App\Exceptions;

use Throwable;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Handler extends ExceptionHandler
{
    use ApiResponser;
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if($exception instanceof HttpException){
            $code = $exception->getStatusCode();
            $message = Response::$statusTexts[$code];

            return $this->errorsResponse($message, $code);
        }
        if($exception instanceof ModelNotFoundException){
            $model = strtolower(class_basename($exception->getModel()));
            $message = "There is no instance of {$model} with the given id";

            return $this->errorsResponse($message,  Response::HTTP_NOT_FOUND);
        }
        if($exception instanceof AuthorizationException){
            $message = $exception->getMessage();

            return $this->errorsResponse($message,  Response::HTTP_FORBIDDEN);
        }
        if($exception instanceof AuthenticationException){
            $message = $exception->getMessage();

            return $this->errorsResponse($message,  Response::HTTP_UNAUTHORIZED);
        }
        if($exception instanceof ValidationException){
            $errors = $exception->validator->errors()->getMessages();

            return $this->errorsResponse($errors,  Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        if($exception instanceof ClientException){
            $message = $exception->getResponse()->getBody();
            $code = $exception->getCode();
            return $this->errorsMessage($message, $code);
        }
        if(env('APP_DEBUG', false)){
            return parent::render($request, $exception);

        }
        return $this->errorsResponse('Unexpected error, Please try again later' , Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
