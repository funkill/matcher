<?php
/**
 * Created by PhpStorm.
 * User: funkill
 * Date: 07.07.15
 * Time: 18:42
 */

namespace Matcher\Types;

use Matcher\Exceptions\BadValueException;

class ObjectTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var Object
     */
    protected $Object;

    protected $input = [];

    protected $matches;

    public function setUp()
    {
        $this->Object = new Object();
        $this->input = [
            new Object(),
            new Integer(),
        ];
        $this->matches = [
            Object::class => function ($el) {
                return true;
            },
            TypeInterface::class => function ($el) {
                return true;
            },
        ];
    }

    public function testExistInput()
    {
        $this->assertTrue($this->Object->match($this->input[0], $this->matches));
    }

    public function testInstance()
    {
        $this->assertTrue($this->Object->match($this->input[1], $this->matches));
    }

    public function testNotExistInput()
    {
        try {
            $this->Object->match(new static(), $this->matches);
        } catch (BadValueException $E) {
            return true;
        } catch (\Exception $E) {
            $this->fail('Unknown exception: '.$E->getMessage());
            return false;
        }

        $this->fail("Exception not raised");
    }

}
