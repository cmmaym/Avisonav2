<?php

namespace AvisoNavAPI\Exceptions;

use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class Handler extends ExceptionHandler
{
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
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
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

        if($exception instanceof NotFoundHttpException){
            return response()->json(['error' => ['title' => 'El recurso solicitado no fue encontrado', 'status' => 404]], 404);
        }
        
        if($exception instanceof MethodNotAllowedHttpException){
            return response()->json(['error' => ['title' => 'El metodo no esta permitido', 'status' => 405]], 405);
        }
        
        if($exception instanceof ModelNotFoundException){
            $model  =   strtolower(class_basename($exception->getModel()));
            return response()->json(['error' => ['title' => "No existe ninguna instancia de $model para el id espesificado", 'status' => 404]], 404);
        }

        if($exception instanceof ValidationException){
            return response()->json(['error' => $exception->errors(), 'status' => 422], 422);
        }
        
        if($exception instanceof QueryException){
            $code = $exception->errorInfo[1];

            switch($code){
                case 1062: 
                    return response()->json(['error' => ['title' => 'No se puede ingresar el registro porque ya existe uno igual'], 'status' => 409], 409);
                default:
                    return response()->json(['error' => ['title' => 'No se pudo realizar la operación'], 'status' => 409], 409);
            }
        }

        if($exception instanceof HttpException){
            return response()->json(['error' => ['title' => 'Ha ocurrido un error inesperado', 'status' => 500]], 500);
        }

        return parent::render($request, $exception);
    }
}
