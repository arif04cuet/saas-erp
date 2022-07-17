<?php

namespace App\Exceptions;

use App\Mail\ExceptionEmail;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\PostTooLargeException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Debug\Exception\FlattenException;
use Symfony\Component\Debug\ExceptionHandler as SymfonyExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;


class Handler extends ExceptionHandler
{
    /**
     *
     */
    private const NO_WEB_SERVER = 'no web server';

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
    public function report(Exception $exception)
    {
        parent::report($exception);

        $e = $this->prepareException($exception);

        if (!$this->shouldntReport($exception) && !$this->isHttpException($e) && $this->shouldSendEmailNotification()) {
            $this->sendEmail($e);
        }
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param Exception $exception
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     */
    public function render($request, Exception $exception)
    {
    //    dd($exception);
        if ($exception instanceof PostTooLargeException) {
            abort(500, trans('error.PostTooLargeException'));
        }

        $e = $this->prepareException($exception);

        if (!$this->shouldntReport($exception) && !$this->isHttpException($e) && $this->shouldSendEmailNotification()) {
            $exception = new HttpException('500', trans('error_500.message'));
        }

        return parent::render($request, $exception);
    }

    /**
     * @param Exception $exception
     */
    public function sendEmail(Exception $exception)
    {
        try {
            $e = FlattenException::create($exception);
            $handler = new SymfonyExceptionHandler();
            $html = $handler->getHtml($e);

            Mail::to($this->validReceivers())->send(new ExceptionEmail($html));

        } catch (Exception $exception) {
            Log::error(
                '500 error Mail -> '
                . get_class($this)
                . " : {$exception->getMessage()}\n{$exception->getTraceAsString()}"
            );
        }

    }

    /**
     * @return bool
     */
    private function shouldSendEmailNotification()
    {
        return $this->runningInWebServer() ? false : in_array($this->server(), $this->validServers);
    }

    /**
     * @return bool
     */
    private function runningInWebServer()
    {
        return (app()->runningUnitTests() || app()->runningInConsole());
    }

    /**
     * @return array $receivers
     */
    private function validReceivers()
    {
        $receivers = collect($this->exceptionEmailReceivers);

        $receivers = $receivers->filter(function ($receiver) {
            return in_array($this->server(), $receiver['servers']);
        });

        return $receivers->pluck('email')->toArray();
    }

    private function server()
    {
        return isset($_SERVER)
            ? (
                isset($_SERVER['SERVER_NAME'])
                    ? $_SERVER['SERVER_NAME']
                    : self::NO_WEB_SERVER
            )
            : self::NO_WEB_SERVER;
    }

}
