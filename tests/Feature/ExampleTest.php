<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\ChapterTwo\TestResult;
use App\ChapterTwo\TestSuite;
use App\ChapterTwo\WasRun;

use App\ChapterOne\Bank;
use App\ChapterOne\Money;
use App\ChapterOne\Sum;
use App\Interface\ChapterOne\Expression;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    //=======CHAPTER ONE=========//

    public function testMultiplication()
    {
        $five = Money::dollar(5);
        $this->assertEquals(Money::dollar(10), $five->times(2));
        $this->assertEquals(Money::dollar(15), $five->times(3));
    }

    public function testEquality()
    {
        $this->assertTrue((Money::dollar(5))->equals(Money::dollar(5)));
        $this->assertFalse((Money::dollar(5))->equals(Money::dollar(6)));
        $this->assertFalse((Money::frank(5))->equals(Money::dollar(5)));
    }

    public function testCurrency()
    {
        $this->assertEquals("USD", Money::dollar(1)->currency());
        $this->assertEquals("CHF", Money::frank(1)->currency());
    }

    public function testSimpleAddition()
    {
        $five = new Money(5, 'USD');

        $sum = $five->plus($five);

        $bank = new Bank();

        $reduced = $bank->reduce($sum, "USD");
        $this->assertEquals(Money::dollar(10), $reduced);
    }

    public function testPlusReturnsSum()
    {
        $five = Money::dollar(5);

        /** @var Sum $sum */
        $sum = $five->plus($five);

        $this->assertEquals($five, $sum->augend);
        $this->assertEquals($five, $sum->addend);
    }

    public function testReduceSum()
    {
        $sum    = new Sum(Money::dollar(3), Money::dollar(4));
        $bank   = new Bank();
        $result = $bank->reduce($sum, 'USD');
        $this->assertEquals(Money::dollar(7), $result);
    }

    public function testReduceMoney()
    {
        $bank   = new Bank();
        $result = $bank->reduce(Money::dollar(1), 'USD');
        $this->assertEquals(Money::dollar(1), $result);
    }

    public function testReduceMoneyDifferentCurrency()
    {
        $bank = new Bank();
        $bank->addRate('CHF', 'USD', 2);

        $result = $bank->reduce(Money::frank(2), 'USD');
        $this->assertEquals(Money::dollar(1), $result);
    }

    public function testIdentityRate()
    {
        $this->assertEquals(1, (new Bank())->rate("USD", "USD"));
    }

    public function testMixedAddition()
    {
        /** @var Expression $fiveBucks */
        $fiveBucks = Money::dollar(5);
        /** @var Expression $tenFrancs */
        $tenFrancs = Money::frank(10);

        $bank = new Bank();
        $bank->addRate("CHF", "USD", 2);

        $result = $bank->reduce($fiveBucks->plus($tenFrancs), 'USD');
        $this->assertEquals(Money::dollar(10), $result);
    }

    public function testSumPlusMoney()
    {
        /** @var Expression $fiveBucks */
        $fiveBucks = Money::dollar(5);
        /** @var Expression $tenFrancs */
        $tenFrancs = Money::frank(10);

        $bank = new Bank();
        $bank->addRate("CHF", "USD", 2);

        $sum = (new Sum($fiveBucks, $tenFrancs))->plus($fiveBucks);
        $res = $bank->reduce($sum, 'USD');

        $this->assertEquals(Money::dollar(15), $res);
    }

    public function testSumTimes()
    {
        /** @var Expression $fiveBucks */
        $fiveBucks = Money::dollar(5);
        /** @var Expression $tenFrancs */
        $tenFrancs = Money::frank(10);

        $bank = new Bank();
        $bank->addRate("CHF", "USD", 2);

        $sum = (new Sum($fiveBucks, $tenFrancs))->times(2);
        $res = $bank->reduce($sum, 'USD');

        $this->assertEquals(Money::dollar(20), $res);
    }


    //=======CHAPTER TWO=========//

    public $test;
    public $result;

    protected function setUp(): void
    {
        parent::setUp();
        $this->test   = new WasRun("testMethod");
        $this->result = new TestResult();
    }

    public function testRunning()
    {
        $this->test->run($this->result);
        $this->assertEquals("setUp testMethod tearDown", $this->test->log);
    }

    public function testResult()
    {
        $test = new WasRun("testMethod");
        $this->test->run($this->result);
        $this->assertEquals("1 run, 0 failed", $this->result->summary());
    }

    public function testFailedResult()
    {
        $test = new WasRun("testBrokenMethod");
        $test->run($this->result);
        $this->assertEquals("1 run, 1 failed", $this->result->summary());
    }

    public function testFailedResultFormatting()
    {
        $this->test = new WasRun("testBrokenMethod");
        $this->test->run($this->result);

        $this->assertEquals("setUp tearDown", $this->test->log);
        $this->assertEquals("1 run, 1 failed", $this->result->summary());
    }

    public function testSuite()
    {
        $suite = new TestSuite();
        $suite->add(new WasRun("testMethod"));
        $suite->add(new WasRun("testBrokenMethod"));

        $result = new TestResult();
        $suite->run($result);

        $this->assertEquals("2 run, 1 failed", $result->summary());
    }
}
