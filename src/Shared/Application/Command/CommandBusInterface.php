<?php

declare(strict_types=1);

namespace Shared\Application\Command;

interface CommandBusInterface
{
    public function dispatch(CommandInterface $command): void;
}
