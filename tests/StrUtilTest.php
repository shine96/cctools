<?php

namespace CCTools\Tests;

use CCTools\Classes\StrUtil;
use PHPUnit\Framework\TestCase;

class StrUtilTest extends TestCase
{
    /**
     * @doesNotPerformAssertions
     */
    public function testrandStr()
    {
        $strUtil = new StrUtil();
        $str = $strUtil->randStr(9);
        echo $str;
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testdesensitize()
    {
        $strUtil = new StrUtil();
        $str = $strUtil->desensitize('18099990000',3,4,'^');
        echo $str;
    }
}