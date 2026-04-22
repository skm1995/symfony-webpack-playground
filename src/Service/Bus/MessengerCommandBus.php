<?php

namespace App\Service\Bus;

use App\Command\CommandInterface;
use App\CommandResponse\CommandResponseInterface;
use App\Enum\BusTransportNameEnum;
use App\Exception\CommandNotRegisteredException;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\Exception\NoHandlerForMessageException;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Messenger\Stamp\StampInterface;
use Symfony\Component\Messenger\Stamp\TransportNamesStamp;

class MessengerCommandBus implements CommandBusInterface
{
    use MessageBusExceptionTrait;

    public function __construct(private readonly MessageBusInterface $commandBus)
    {
    }

    /**
     * @param array<StampInterface> $stamps
     */
    public function dispatchSync(CommandInterface $command, array $stamps = []): CommandResponseInterface
    {
        try {
            $stamps[] = new TransportNamesStamp([BusTransportNameEnum::SYNC->value]);
            $envelope = $this->commandBus->dispatch($command, $stamps);

            /** @var HandledStamp $stamp */
            $stamp = $envelope->last(HandledStamp::class);

            $result = $stamp->getResult();

            if (!$result instanceof CommandResponseInterface) {
                throw $this->createResponseException();
            }

            return $result;
        } catch (NoHandlerForMessageException $exception) {
            throw new CommandNotRegisteredException($command, $exception);
        } catch (HandlerFailedException $exception) {
            $wrappedExceptions = $exception->getWrappedExceptions();

            if (!empty($wrappedExceptions)) {
                throw min($wrappedExceptions);
            }

            throw $exception;
        }
    }

    public function dispatchAsync(CommandInterface $command, array $stamps = []): void
    {
        try {
            $stamps[] = new TransportNamesStamp([BusTransportNameEnum::ASYNC->value]);
            $this->commandBus->dispatch($command, $stamps);
        } catch (NoHandlerForMessageException $exception) {
            throw new CommandNotRegisteredException($command, $exception);
        } catch (\Throwable $exception) {
            throw new \Exception($exception->getMessage(), $exception->getCode(), $exception);
        }
    }
}
