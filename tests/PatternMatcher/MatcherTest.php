<?php
/**
 * Created by PhpStorm.
 * User: funkill
 * Date: 06.07.15
 * Time: 17:18
 */

namespace Matcher;

use Matcher\Exceptions\BadValueException;

class MatcherTest extends \PHPUnit_Framework_TestCase
{

    protected $input = 2;

    protected $patterns;

    public function setUp()
    {
        $this->patterns = [
            false => function ($el) {
                return $el;
            },
            2 => function ($el) {
                return $el;
            },
        ];
    }

    public function testBadType()
    {
        try {
            Matcher::match((string)$this->input, $this->patterns);
        } catch (BadValueException $E) {
            return true;
        }

        $this->fail("Matcher match value!");
    }

    public function testMatch()
    {
        $result = Matcher::match($this->input, $this->patterns);
        $this->assertEquals($this->input, $result);
    }

}