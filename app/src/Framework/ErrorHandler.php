<?php

declare(strict_types=1);


namespace Framework;

use Framework\Exceptions\PageNotFoundException;
use ErrorException;
use Throwable;

class ErrorHandler
{
    //Handle error throw exception for next handler with information
    public static function handleError(
        int    $errno,
        string $errstr,
        string $errfile,
        int    $errline): bool
    {
        throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
    }

    //Definite response code, view template for exception (if we don't show errors)
    public static function handleException(Throwable $exception): void
    {
        if ($exception instanceof PageNotFoundException) {

            http_response_code(404);

            $template = "Errors/404.php";

        } else {

            http_response_code(500);

            $template = "Errors/500.php";

        }

        if ($_ENV["SHOW_ERRORS"]) {

            ini_set('display_errors', "1");

        } else {

            ini_set('display_errors', "0");

            ini_set('log_errors', "1");

            require dirname(__DIR__,2)."/views/$template";
        }
        throw $exception;
    }
}