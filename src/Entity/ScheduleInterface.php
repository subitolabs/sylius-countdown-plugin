<?php

declare(strict_types=1);

namespace Subitolabs\SyliusCountdownPlugin\Entity;

use DateTimeInterface;
use Sylius\Component\Resource\Model\CodeAwareInterface;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Resource\Model\ToggleableInterface;


interface ScheduleInterface extends ResourceInterface, CodeAwareInterface, ToggleableInterface
{
    public function getStartsAt(): ?DateTimeInterface;

    public function setStartsAt(?DateTimeInterface $startsAt): void;

    public function getEndsAt(): ?DateTimeInterface;

    public function setEndsAt(?DateTimeInterface $endsAt): void;

    public function getPriority(): int;

    public function setPriority(int $priority): void;
}
