<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\PostTooLargeException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Debug\Exception\FlattenException;
use Symfony\Component\Debug\ExceptionHandler as SymfonyExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
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
     * @var array $exceptionEmailReceivers
     */
    protected $exceptionEmailReceivers = [
        [
            'email' => 'sahib@inflack.com',
            'servers' => [
                'uat.bard.inflack.com',
            ]
        ],
        [
            'email' => 'suman.inflack@gmail.com',
            'servers' => [
                'uat.bard.inflack.com'
            ]
        ],
        [
            'email' => 'yousha@inflack.com',
            'servers' => [
                'uat.bard.inflack.com',
                'localhost'
            ]
        ]
    ];

    /**
     * @var array $validServers
     */
    protected $validServers = [
        'localhost',
        'uat.bard.inflack.com'
    ];

    /**
     * Report or log an exception.
     *
     * @param \Exception $exception
     * @return void
     * @throws Exception
     */
    // public function report(Exception $exception)
    // {
    //     parent::report($exception);

    //     $e = $this->prepareException($exception);

    //     if (!$this->shouldntReport($exception) && !$this->isHttpException($e) && $this->shouldSendEmailNotification()) {
    //         $this->sendEmail($e);
    //     }
    // }

    /**
     * @param \Illuminate\Http\Request $request
     * @param Exception $exception
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     */
    // public function render($request, Exception $exception)
    // {
    // //    dd($exception);
    //     if ($exception instanceof PostTooLargeException) {
    //         abort(500, trans('error.PostTooLargeException'));
    //     }

    //     $e = $this->prepareException($exception);

    //     if (!$this->shouldntReport($exception) && !$this->isHttpException($e) && $this->shouldSendEmailNotification()) {
    //         $exception = new HttpException('500', trans('error_500.message'));
    //     }

    //     return parent::render($request, $exception);
    // }

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
}
