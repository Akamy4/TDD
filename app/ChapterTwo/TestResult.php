<?php

declare(strict_types=1);

namespace App\ChapterTwo;

final class TestResult
{
    public mixed $runCount;
    public mixed $errorCount;

    public function __construct()
    {
        $this->runCount   = 0;
        $this->errorCount = 0;
    }

    public function testStarted()
    {
        ++$this->runCount;
    }

    public function testFailed()
    {
        ++$this->errorCount;
    }

    public function summary()
    {
        return sprintf('%d run, %d failed', $this->runCount, $this->errorCount);
    }
}
