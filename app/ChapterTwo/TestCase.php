<?php

declare(strict_types=1);

namespace App\ChapterTwo;

class TestCase
{
    protected string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function setUp(): void
    {
    }

    public function tearDown(): void
    {
    }

    public function run(TestResult $result): TestResult
    {
        $result->testStarted();
        $this->setUp();
        try {
            $method = $this->name;
            $this->$method();
        } catch (\Exception $exception) {
            $result->testFailed();
        }
        $this->tearDown();
        return $result;
    }
}
