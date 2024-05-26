<?php

declare(strict_types=1);

namespace App\ChapterOne;

use App\Interface\ChapterOne\Expression;

class Money implements Expression
{
    public function __construct(
        public int $amount,
        public string $currency,
    ) {
    }

    public function times(int $multiplier): Expression
    {
        return new Money($this->amount * $multiplier, $this->currency);
    }
    public function currency(): string
    {
        return $this->currency;
    }

    public static function dollar(int $amount): self
    {
        return new Money($amount, 'USD');
    }

    public static function frank(int $amount): self
    {
        return new Money($amount, 'CHF');
    }

    public function equals($object): bool
    {
        /** @var Money $money */
        $money = $object;

        return $this->amount === $money->amount
            && $this->currency === $money->currency;
    }

    public function plus(Expression $addend): Expression
    {
        return new Sum($this, $addend);
    }

    public function reduce(Bank $bank, string $to): self
    {
        $rate = $bank->rate($this->currency, $to);

        return new Money($this->amount / $rate, $to);
    }
}
