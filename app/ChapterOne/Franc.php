<?php

declare(strict_types=1);

namespace App\ChapterOne;

final class Franc extends Money
{
    public static function frank(int $amount): Money
    {
        return new Money($amount, 'CHF');
    }
}

