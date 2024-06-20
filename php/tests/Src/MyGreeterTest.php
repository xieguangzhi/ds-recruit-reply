<?php

use PHPUnit\Framework\TestCase;
use Src\MyGreeter;

/**
 * 原单元测试类存在问题，
 * 1.方法命名不遵循psr4规范
 * 2.没有根据具体时间测试每一个场景，增加了具体场景的test
 */

class MyGreeterTest extends TestCase
{
    private MyGreeter $greeter;

    public function setUp(): void
    {
        $this->greeter = new MyGreeter();
    }

    //方法命名和setUp方法保持一致
    public function testInit()
    {
        $this->assertInstanceOf(
            MyGreeter::class,
            $this->greeter
        );
    }

    //方法命名和setUp方法保持一致
    public function testGreeting()
    {
        $this->assertTrue(
            strlen($this->greeter->greeting()) > 0
        );
    }

    /**
     * 测试6AM至12AM之间的问候语
     */
    public function testMorningGreeting()
    {
        // 模拟时间为8AM
        $this->mockTime('08:00');
        $this->assertEquals('Good morning', $this->greeter->greeting());
    }

    /**
     * 测试12AM至6PM之间的问候语
     */
    public function testAfternoonGreeting()
    {
        // 模拟时间为2PM
        $this->mockTime('14:00');
        $this->assertEquals('Good afternoon', $this->greeter->greeting());
    }

    /**
     * 测试6PM至第二天6AM之间的问候语
     */
    public function testEveningGreeting()
    {
        // 模拟时间为8PM
        $this->mockTime('20:00');
        $this->assertEquals('Good evening', $this->greeter->greeting());
    }

    /**
     * 模拟当前时间
     * @param string $time 格式为 'H:i'
     */
    private function mockTime(string $time): void
    {
        $time = strtotime($time);
        \Closure::bind(function () use ($time) {
            putenv('MOCK_TIME=' . $time);
        }, null, null)();
    }

}
