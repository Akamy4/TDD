<?php

declare(strict_types=1);

namespace App\ChapterTwo;

final class WasRun extends TestCase
{
    public string $log = '';

    public function __construct($name)
    {
        $this->log = "";
        parent::__construct($name);
    }

    public function setUp(): void
    {
        $this->log = "setUp ";
    }

    public function tearDown(): void
    {
        $this->log .= "tearDown";
    }

    public function testMethod(): void
    {
        $this->log .= "testMethod ";
    }

    public function testBrokenMethod()
    {
        throw new \Exception();
    }
}
