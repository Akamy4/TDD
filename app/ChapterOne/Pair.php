<?php

declare(strict_types=1);

namespace App\ChapterOne;

final class Pair
{
    public function __construct(
        public string $from,
        public string $to,
    ) {
    }

    public function equals(self $object): bool
    {
        return $this->from === $object->from && $this->to === $object->to;
    }

    public function hashCode(): int
    {
        return 0;
    }
}
