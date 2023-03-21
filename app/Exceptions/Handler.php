<?php

namespace App\Exceptions;

use Faker\Core\Uuid;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Illuminate\Auth\AuthenticationException;
use Throwable;

class Handler extends ExceptionHandler
{

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
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }


    protected $code = 0;
    protected $levels = [
        100 => 'debug',
        200 => 'info',
        300 => 'notice',
        400 => 'notice',
        500 => 'warning',
        600 => 'error',
        700 => 'critical',
        800 => 'alert',
        900 => 'emergency',
    ];
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    public function render($request, Throwable $exception)
    {
        $classArray = explode(DIRECTORY_SEPARATOR, get_class($exception));
        switch (end($classArray)) {
            case 'MethodNotAllowedHttpException':
                $this->code = 500;
                break;
            case 'NotFoundHttpException':
                $this->code = 600;
                break;
            case 'QueryException':
                $this->code = 700;
                break;
            case 'ReflectionException':
                $this->code = 800;
                break;
            default:
                $this->code = 900;
        }
        if ($this->code) {
            $msg = [
                500 => '请求类型不匹配',
                600 => '请求地址未开放',
                700 => '数据库语句错误',
                800 => '服务端接口异常',
                900 => '程序错误请重试',
            ];
            $result = [
                'request' => false,
                'data'    => $exception->getMessage(),
                'code'    => $this->code,
                'msg'     => $msg[$this->code],
            ];
            Log::log($this->levels[$this->code], 'Render Data', $result);
            return response()->json($result, 404);
        }
        return parent::render($request, $exception);
        // return response(end($classArray));

    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return response()->json(['error' => 'Unauthenticated.'], 401);
    }
}
