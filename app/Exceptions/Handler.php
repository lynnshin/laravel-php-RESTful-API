<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException; 
use Illuminate\Database\QueryException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var string[]
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var string[]
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
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    private function makeJson($status, $data, $statusCode)
    {
        //轉 JSON 時確保中文不會變成 Unicode
        return response()->json(['status' => $status, 'data' => $data], $statusCode)->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof ModelNotFoundException) {
            // 回傳資源時 使用 Model::findOrFail 找不到資源時統一回傳
            return $this->makeJson('failed', null, Response::HTTP_NOT_FOUND);
        }
        if ($exception instanceof QueryException) {
            // 回傳資源時 使用 Model::findOrFail 找不到資源時統一回傳
            return $this->makeJson('failed', null, Response::HTTP_EXPECTATION_FAILED);
        }

        return parent::render($request, $exception);
    }
}
