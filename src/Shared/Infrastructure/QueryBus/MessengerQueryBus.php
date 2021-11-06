<?php

declare(strict_types=1);

namespace Shared\Infrastructure\QueryBus;

use Shared\Application\Query\QueryBusInterface;
use Shared\Application\Query\QueryInterface;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

final class MessengerQueryBus implements QueryBusInterface
{
    use HandleTrait;

    private MessageBusInterface $queryBus;

    public function __construct(MessageBusInterface $queryBus)
    {
        $this->queryBus = $queryBus;
    }

    public function query(QueryInterface $query): mixed
    {
        return $this->handle($query);
    }
}
