<?php

namespace App\Exception;

use App\Command\CommandInterface;

class CommandNotRegisteredException extends \Exception
{
    private const string MESSAGE_FORMAT = "The command <%s> hasn't a command handler associated";

    public function __construct(CommandInterface $command, \Throwable $previous)
    {
        parent::__construct(
            sprintf(self::MESSAGE_FORMAT, get_class($command)),
            $previous->getCode(),
            $previous
        );
    }
}
