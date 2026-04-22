<?php

namespace App\Service\Bus;

use App\Command\CommandInterface;
use App\CommandResponse\CommandResponseInterface;
use Symfony\Component\Messenger\Stamp\StampInterface;

interface CommandBusInterface
{
    /**
     * @param array<StampInterface> $stamps
     */
    public function dispatchSync(CommandInterface $command, array $stamps = []): CommandResponseInterface;

    /**
     * @param array<StampInterface> $stamps
     */
    public function dispatchAsync(CommandInterface $command, array $stamps = []): void;
}
