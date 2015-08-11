<?php
/**
 * Created by PhpStorm.
 * User: funkill
 * Date: 06.07.15
 * Time: 19:50
 */

namespace Matcher\Types;

use Matcher\Exceptions\BadValueException;


/**
 * Class IntegerTest
 * @package PatternMatcher\Types
 */
class IntegerTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var TypeInterface $Integer
     */
    protected $Integer;

    /**
     * @var array $matches
     */
    protected $matches;

    public function setUp()
    {
        $this->Integer = new Integer();
        $this->matches = [
            5 => function ($el) {
                return $el;
            },
        ];
    }

    public function testExistInput()
    {
        $keys = array_keys($this->matches);
        $value = array_pop($keys);

        $this->assertEquals($value, $this->Integer->match($value, $this->matches));
    }

    public function testNotExistInput()
    {
        $keys = array_keys($this->matches);
        $value = array_pop($keys) + 1;

        try {
            $this->Integer->match($value, $this->matches);
        } catch (BadValueException $BVE) {
            return true;
        } catch (\Exception $E) {
            $this->fail('Unknown exception: '.$E->getMessage());
            return false;
        }

        $this->fail("Exception not raised");
    }


}
