<?php

namespace App\Exceptions;

use App\Utils\ApiResponser;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    use ApiResponser;
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof ModelNotFoundException &&
            $request->wantsJson()) {

            $modelName = strtolower(class_basename($exception->getModel()));

            $message = "Resource {$modelName} not found";

            return $this->errorResponse($message, 404);
        }

        if ($exception instanceof AuthenticationExeption) {
            $message = "The specified URL cannot be found";

            return $this->unauthenticated($request, $exception);
        }

        if ($exception instanceof AuthorizationException) {
            $message = $exception->getMessage();

            return $this->errorResponse($message, 403);
        }

        if ($exception instanceof MethodNotAllowedHttpException) {
            $message = "The specified method for the request is invalid";

            return $this->errorResponse($message, 405);
        }

        if ($exception instanceof NotFoundHttpException) {
            $message = "The specified URL cannot be found";

            return $this->errorResponse($message, 403);
        }

        if ($exception instanceof HttpException) {
            $message = $exception->getMessage();

            return $this->errorResponse($message, $exception->getStatusCode());
        }

        return parent::render($request, $exception);
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return response()->json(['error' => 'Unauthenticated'], 401);
    }
}
