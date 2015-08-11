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
 * Class StringTest
 * @package PatternMatcher\Types
 */
class StringTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var TypeInterface $String
     */
    protected $String;

    /**
     * @var array $matches
     */
    protected $matches;

    public function setUp()
    {
        $this->String = new String();
        $this->matches = [
            'test' => function ($el) {
                return $el;
            },
        ];
    }

    public function testExistInput()
    {
        $keys = array_keys($this->matches);
        $value = array_pop($keys);

        $this->assertEquals($value, $this->String->match($value, $this->matches));
    }

    public function testNotExistInput()
    {
        $keys = array_keys($this->matches);
        $value = array_pop($keys) . '_not_matched';

        try {
            $this->String->match($value, $this->matches);
        } catch (BadValueException $BVE) {
            return true;
        } catch (\Exception $E) {
            $this->fail('Unknown exception: '.$E->getMessage());
            return false;
        }

        $this->fail("Exception not raised");
    }


}
