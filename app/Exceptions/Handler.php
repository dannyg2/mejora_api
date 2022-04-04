<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Support\Str;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    use ApiResponser;

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function render($request, Throwable $exception)
    {
        DD($exception);
        
        if ($exception instanceof ValidationException) {
            return $this->errorResponse($exception->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        if ($exception instanceof TokenInvalidException && ($request->expectsJson() || Str::startsWith($request->path(), 'api/'))) {
            return $this->errorResponse('Token is Invalid', Response::HTTP_UNAUTHORIZED);
        }
        if ($exception instanceof TokenExpiredException && ($request->expectsJson() || Str::startsWith($request->path(), 'api/'))) {
            return $this->errorResponse('Token is Expired', Response::HTTP_FORBIDDEN);
        }

        if( $exception instanceof ModelNotFoundException && ($request->expectsJson() || Str::startsWith($request->path(), 'api/'))) {
            return $this->errorResponse('Model not found', 404);
        }

        if( $exception instanceof NotFoundHttpException && ($request->expectsJson() || Str::startsWith($request->path(), 'api/')) ) {
            $this->errorResponse('Resource not found', 404);
        }
        if(config('app.env') != 'local' && ($request->expectsJson() || Str::startsWith($request->path(), 'api/') ) ) {
            $data= [
                "getMessage"=>$exception-> getMessage(),
                "getPrevious"=>$exception->getPrevious(),
                "getCode"=>$exception->getCode(),
                "getFile"=>$exception->getFile(),
                "getLine"=>$exception->getLine(),
                "getTrace"=>$exception->getTrace(),
            ];
            return $this->errorResponse('Revisar log del sistema', Response::HTTP_INTERNAL_SERVER_ERROR);

        }
    }

     /**
     * Report or log an exception.
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
}
