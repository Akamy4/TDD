<?php

declare(strict_types=1);

namespace App\ChapterTwo;


class TestCase
{
    protected $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function setUp()
    {
    }

    public function tearDown()
    {
    }

    public function run()
    {
        $res = new TestResult();
        $res->testStarted();
        $this->setUp();
        try {
            $method = $this->name;
            $this->$method();
        } catch (\Exception $exception) {
            $res->testFailed();
        }
        $this->tearDown();
        return $res;
    }
}
