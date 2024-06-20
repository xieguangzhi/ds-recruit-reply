<?php

namespace Src;

/**
 * 希望你实现一个类（MyGreeter），满足以下条件：
 * 能够实例化。
 * 实现一个方法（让我们叫他greeting），能够根据不同的运行时间返回不同的消息字符串。
 * 当运行时间在6AM至12AM之间时，返回 "Good morning"。
 * 当运行时间在12AM至6PM之间时，返回 "Good afternoon"。
 * 当运行时间在6PM至第二天6AM之间时，返回 "Good evening"。
 * 在适当的位置编写简明扼要的注释以提高你编写的代码的可读性。
 * 希望你实现的这个类能通过我们预先准备的单元测试类（MyGreeterTest）
 * 我们准备了一个容器运行环境来供你运行单元测试，你需要根据实际情况对它进行改进，至少满足以下条件：
 * make dev-tests 这个命令可以在你的环境里运行。
 * 运行结果显示，所有的测试项目都正常通过。
 * 请用注释或者别的方式说明你的每个改进点的意图。
 * 如果你认为这个容器环境不存在值得改进的地方，也请提供用来支撑你这个看法的理由。
 */
class MyGreeter
{
    public function __construct()
    {
        //设置时区
        date_default_timezone_set('Asia/Shanghai');
    }

    /**
     * 自定义date
     * @param $format
     * @param $timestamp
     * @return string
     */
    public function customDate($format, $timestamp = null): string
    {
        $mockTime = getenv('MOCK_TIME');
        if ($mockTime !== false) {
            $timestamp = $mockTime;
        } else {
            $timestamp = $timestamp ?? time();
        }

        return \date($format, $timestamp);
    }

    /**
     * 获取不同时间段的返回
     * @return string
     */
    public function greeting(): string
    {
        $currentHour = $this->customDate('H');

        if ($currentHour >= 6 && $currentHour < 12) {
            return "Good morning";
        } elseif ($currentHour >= 12 && $currentHour < 18) {
            return "Good afternoon";
        } else {
            return "Good evening";
        }
    }
}