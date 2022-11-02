<?php

namespace App\Exceptions;

use App\Exceptions\Kiirathato\KiirathatoException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

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
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param Throwable $e
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     * @throws Throwable
     */
    public function render($request, Throwable $e)
    {
        report($e);
        //if(in_array($e->getCode(), [404,500]))

        if ($request->wantsJson()) {
            $status = $e->getCode();
            if ($status === 0) {
                $status = 400;
            }
            if (in_array($status, [204, 404])) {
                return response()->noContent($status);
            } else {
                return response()->json([
                    "message" => $e->getMessage(),
                    "code" => $e->getCode(),
                    "trace" => config('app.debug') ? $e->getTrace() : [],
                ], $status);
            }
        }
        if (
            (($i = $e) instanceof KiirathatoException)
            || (($i = $e->getPrevious()) instanceof KiirathatoException)
        ) {
            errorMsg($i->getMessage());
            if ($request->getMethod() === "POST") {
                return redirect($request->getRequestUri());
            }
            return redirect()->route("index");
        }

        return parent::render($request, $e);
    }
}
