<?php

declare(strict_types=1);

namespace App\ChapterTwo;

final class WasRun extends TestCase
{
    public mixed $log = '';

    public function __construct($name)
    {
        $this->log = "";
        parent::__construct($name);
    }

    public function setUp()
    {
        $this->log = "setUp ";
    }

    public function testMethod()
    {
        $this->log .= "testMethod ";
    }

    public function tearDown()
    {
        $this->log .= "tearDown";
    }

    public function testBrokenMethod()
    {
        throw new \Exception('234');
    }
}
