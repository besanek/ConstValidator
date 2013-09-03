<?php

/**
 * @author Robert Jelen <robert.jelen@email.cz>
 * @testcase ConstValidator\Tests\ValidateTest
 */

namespace ConstValidator\Tests;

use Tester\Assert;
use ConstValidator\Validator as Constant;

require __DIR__ . '/../bootstrap.php';

/**
 * @author Robert Jelen <robert.jelen@email.cz>
 * @testcase ConstValidator\Tests\ValidateTest
 */
class ValidateTest extends \Tester\TestCase {

    public function dataProvider(){
        return array(
            array("STATUS_*", 1, true),
            array("STATUS_*", 2, true),
            array("STATUS_*", 'tri', true),
            array("ANY_OTHER", 4, true),
            array("STATUS_TWO", 1, false),
            array("STATUS_*", '2', false),
            array("STATUS_*", 3, false),
            array("ANY_OTHER", 5, false),
        );
    }

    /**
     * @dataProvider dataProvider
     */
    public function testValidity($const, $value, $expected){
        $className = '\ConstValidator\Tests\Helpers\TestClass';
        $expr = $className . '::' . $const;
        $actual = Constant::validate($expr, $value);
        Assert::equal($expected, $actual);
    }

}

self(new ValidateTest)->run();
