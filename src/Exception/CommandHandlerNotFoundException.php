<?php

namespace App\Exception;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CommandHandlerNotFoundException extends HttpException
{
    private const string EXCEPTION_MESSAGE = "Command throw error message: %s";

    public function __construct(
        string $message,
    ) {
        parent::__construct(
            Response::HTTP_NOT_FOUND,
            sprintf(self::EXCEPTION_MESSAGE, $message)
        );
    }
}
