<?php

declare(strict_types=1);

namespace App\ChapterOne;

use App\Interface\ChapterOne\Expression;
use Illuminate\Support\Collection;

final class Bank
{
    public function __construct(
        private readonly Collection $rates = new Collection(),
    ) {
    }

    public function reduce(Expression $source, string $to): Money
    {
        return $source->reduce($this, $to);
    }

    // Метод для установки значения в коллекцию
    public function addRate(string $from, string $to, int $rate): void
    {
        $this->rates->put($from . '_' .$to, $rate);
    }

    // Метод для получения значения из коллекции
    public function getRate(string $from, string $to): int
    {
        return (int)$this->rates->get($from . '_' .$to);
    }

    // Метод для удаления значения из коллекции
    public function removeRate($key): void
    {
        $this->rates->forget($key);
    }
    public function rate(string $from, string $to): int
    {
        if ($from === $to) {
            return 1;
        }

        return $this->getRate($from, $to);
    }
}
