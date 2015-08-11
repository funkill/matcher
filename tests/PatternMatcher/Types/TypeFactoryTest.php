<?php
/**
 * Created by PhpStorm.
 * User: funkill
 * Date: 06.07.15
 * Time: 19:26
 */

namespace Matcher\Types;


use Matcher\Exceptions\TypeInterfaceException;
use Matcher\Exceptions\TypeNotFoundException;

class TestTypeClass
{
}

class TypeFactoryTest extends \PHPUnit_Framework_TestCase
{

    protected $Type;

    /**
     * @var TypeFactory $TypeFactory
     */
    protected $TypeFactory;

    public function setUp()
    {
        $this->Type = null;
        $this->TypeFactory = new TypeFactory();
    }

    public function testNotExistsType()
    {
        try {
            $this->Type = $this->TypeFactory->create('not_exists_type');
        } catch (TypeNotFoundException $E) {
            $this->assertNull($this->Type);
            return true;
        }

        $this->fail("Factory create type!");
    }

    public function testWrongClass()
    {
        try {
            $this->Type = $this->TypeFactory->create(TestTypeClass::class);
        } catch (TypeInterfaceException $E) {
            $this->assertNull($this->Type);
            return true;
        }

        $this->fail("Factory create type!");
    }

    public function testCreate()
    {
        $Type = $this->TypeFactory->create(Integer::class);
        $this->assertNotNull($Type);
        $this->assertInstanceOf(Integer::class, $Type);
    }

    public function testAlias()
    {
        $Type = $this->TypeFactory->create('int');
        $this->assertNotNull($Type);
        $this->assertInstanceOf(Integer::class, $Type);
    }

    public function testDetectInt()
    {
        $type = $this->TypeFactory->detect(5);
        $this->assertEquals(Integer::class, Aliases::instance()->get($type));
    }

    public function testDetectObject()
    {
        $type = $this->TypeFactory->detect(new static());
        $this->assertEquals('object', $type);
    }

    public function testDetectObjectString()
    {
        $example = [
            TypeFactory::class => '1',
        ];
        $types = array_keys($example);
        $type = array_shift($types);
        $resultType = $this->TypeFactory->detect($type);
        $this->assertEquals('object', $resultType);
    }

}

