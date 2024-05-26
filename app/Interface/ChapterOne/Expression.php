<?php

declare(strict_types=1);

namespace App\Interface\ChapterOne;

use App\ChapterOne\Bank;
use App\ChapterOne\Money;

interface Expression
{
    public function reduce(Bank $bank, string $to): Money;
    public function plus(Expression $addend): Expression;
    public function times(int $multiplier): Expression;
}
