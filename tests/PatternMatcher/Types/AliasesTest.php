<?php
/**
 * Created by PhpStorm.
 * User: funkill
 * Date: 07.07.15
 * Time: 17:52
 */

namespace Matcher\Types;


use Matcher\Exceptions\AliasException;

class AliasesTest extends \PHPUnit_Framework_TestCase
{

    protected $type = Integer::class;
    protected $alias = 'integer';


    public function testNotExists()
    {
        $result = Aliases::instance()->exists($this->alias.'_wrong');
        $this->assertFalse($result);
    }

    public function testExist()
    {
        $result = Aliases::instance()->exists($this->alias);
        $this->assertTrue($result);
    }

    public function testGetException()
    {
        try {
            Aliases::instance()->get($this->alias.'_wrong');
        } catch (AliasException $AE) {
            return true;
        } catch (\Exception $E) {
            $this->fail('Unknown exception: '.$E->getMessage());
            return false;
        }

        $this->fail("Exception not raised");
    }

    public function testGetAlias()
    {
        $alias = null;
        try {
            $alias = Aliases::instance()->get($this->alias);
        } catch (\Exception $E) {
            $this->fail(sprintf('Exception `%s` on positive test `getAlias`', $E->getMessage()));
        }

        $this->assertNotNull($alias);
        $this->assertEquals($this->type, $alias);
    }

}
