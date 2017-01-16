<?php

use Tradeshift\Interview\Logger;

// create a log channel


set_error_handler('errorHandler');
register_shutdown_function('shutdownHandler');

/**
 * Shutdown Handler: transforms PHP Fatal Errors into Exceptions
 *
 * @throws ErrorException
 * @return void
 */
function shutdownHandler()
{
    try {
        $error = error_get_last();
        if (isset($error)) {
            throw new ErrorException($error['message'], 0, $error['type'], $error['file'], $error['line']);
        }
    } catch (Exception $e) {
        Logger::getInstance()->error(var_export($e, true));
    }
}

/**
 * @param int $errno
 * @param string $errstr
 * @param string $errfile
 * @param int $errline
 */
function errorHandler($errno, $errstr, $errfile, $errline)
{
    $ex = new ErrorException($errstr, 0, $errno, $errfile, $errline);

    Logger::getInstance()->exception(var_export($ex, true), [], [
        'GET' => $_GET,
        'POST' => $_POST,
        'REQUEST' => $_REQUEST,
        'COOKIE' => $_COOKIE,
        'SERVER' => $_SERVER
    ]);
}

