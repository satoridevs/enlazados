<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Database\Eloquent\ModelNotFoundException;  
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Database\QueryException;

use App\Traits\ApiResponser;

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
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Throwable
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
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {   
        if($exception instanceof ModelNotFoundException){            
            $modelo = strtolower(class_basename($exception->getModel()));
            return $this->errorResponse("No existe ningun dato con el valor especificado para el modelo: {$modelo}",404);
        }

        if($exception instanceof NotFoundHttpException){  
            return $this->errorResponse("No se encontro la url especificada",404);
        }

        if ($exception instanceof MethodNotAllowedHttpException) {
            return $this->errorResponse('El verbo especificado en la petición no es válido', 405);
        }

        if ($exception instanceof HttpException) {
            return $this->errorResponse($exception->getMessage(), $exception->getStatusCode());
        }

        if ($exception instanceof QueryException) {
            $codigo = $exception->errorInfo[1];

            if ($codigo == 1062) {                
                return $this->errorResponse("Error de integridad de los datos para el modelo", 409);
            }
        }

        if (config('app.debug')) {
            return parent::render($request, $exception);            
        }

        return $this->errorResponse('Falla inesperada. Intente luego', 500);
        
    }

}
