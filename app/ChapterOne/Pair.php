<?php

declare(strict_types=1);

namespace App\ChapterOne;

use PhpParser\Node\Expr\Cast\Object_;

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
