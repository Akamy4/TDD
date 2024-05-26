<?php

declare(strict_types=1);

namespace App\ChapterTwo;

use Illuminate\Support\Collection;

final class TestSuite
{
    public Collection $tests;
    public function __construct()
    {
        $this->tests = collect();
    }

    public function add(TestCase $test): void
    {
        $this->tests->push($test);
    }

    public function run(TestResult $res): void
    {
        foreach ($this->tests as $test) {
            $test->run($res);
        }
    }
}
