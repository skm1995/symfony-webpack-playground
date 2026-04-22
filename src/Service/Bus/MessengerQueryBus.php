<?php

namespace App\Service\Bus;

use App\Query\QueryInterface;
use App\QueryResponse\QueryResponseInterface;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\Exception\NoHandlerForMessageException;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;

/**
 * @template T of QueryResponseInterface
 * @implements QueryBusInterface<T>
 */
class MessengerQueryBus implements QueryBusInterface
{
    use MessageBusExceptionTrait;

    public function __construct(private readonly MessageBusInterface $queryBus)
    {
    }

    /**
     * @return T
     */
    public function ask(QueryInterface $query): QueryResponseInterface
    {
        try {
            /** @var HandledStamp $stamp */
            $stamp = $this->queryBus->dispatch($query)->last(HandledStamp::class);

            $result = $stamp->getResult();

            if (! $result instanceof QueryResponseInterface) {
                throw $this->createResponseException();
            }

            /** @var T $result */
            return $result;
        } catch (NoHandlerForMessageException $exception) {
            throw new \InvalidArgumentException($exception->getMessage(), $exception->getCode(), $exception);
        } catch (HandlerFailedException $exception) {
            $wrappedExceptions = $exception->getWrappedExceptions();

            if (!empty($wrappedExceptions)) {
                throw min($wrappedExceptions);
            }

            throw $exception;
        }
    }
}
