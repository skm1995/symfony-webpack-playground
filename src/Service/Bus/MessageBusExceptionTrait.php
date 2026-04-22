<?php

namespace App\Service\Bus;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Messenger\Exception\HandlerFailedException;

trait MessageBusExceptionTrait
{
    private const string INVALID_RESPONSE_TYPE_MESSAGE = 'Invalid response type.';
    private const string HANDLER_FAILED_MESSAGE = 'Handler failed.';

    public function throwHandlerFailedException(HandlerFailedException $exception): void
    {
        while ($exception instanceof HandlerFailedException) {
            $exception = $exception->getPrevious();
        }

        if ($exception instanceof \Throwable) {
            throw $exception;
        }

        throw new \LogicException(self::HANDLER_FAILED_MESSAGE);
    }

    public function createHandlerException(string $message, int $code): HttpException
    {
        return new HttpException($code, $message);
    }

    public function createResponseException(): \Exception
    {
        return new \Exception(self::INVALID_RESPONSE_TYPE_MESSAGE, Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
