<?php

declare(strict_types=1);

namespace App\ChapterTwo;

final class TestResult
{
    public int $runCount;
    public int $errorCount;

    public function __construct()
    {
        $this->runCount   = 0;
        $this->errorCount = 0;
    }

    public function testStarted(): void
    {
        ++$this->runCount;
    }

    public function testFailed(): void
    {
        ++$this->errorCount;
    }

    public function summary(): string
    {
        return sprintf('%d run, %d failed', $this->runCount, $this->errorCount);
    }
}
