<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Routing\ResponseFactory\Route;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;

// use Illuminate\Auth\Access\UnauthorizedException;
class Handler extends ExceptionHandler
{
    protected $dontReport = [
        //
    ];
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }
    public function render($request, Throwable $exception)
    {
        if ($this->isHttpException($exception)) {
            if ($exception->getStatusCode() == 404) {
                if (request()->is('admin/*')) {
                    return redirect()->route('admin.404');
                }else{
                    return redirect()->route('404');
                }

            }
            if ($exception->getStatusCode() == 500) {
                if (request()->is('admin/*')) {
                    return redirect()->route('admin.500');
                }else{
                    return redirect()->route('500');
                }
            }
            if ($exception->getStatusCode() == 403) {
                dd(1);
            }
        }
         
        return parent::render($request, $exception);
    }
}
