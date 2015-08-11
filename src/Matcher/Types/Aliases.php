<?php
/**
 * Created by PhpStorm.
 * User: funkill
 * Date: 07.07.15
 * Time: 17:50
 */

namespace Matcher\Types;


use Matcher\Exceptions\AliasException;

class Aliases
{

    /**
     * @var Aliases $Instance
     */
    protected static $Instance;
    protected $aliases = [
        'integer' => Integer::class,
        'int' => Integer::class,
        'object' => Object::class,
    ];

    protected function __construct(){}

    /**
     * @return Aliases
     */
    public static function instance()
    {
        if (null === static::$Instance) {
            static::$Instance = new static();
        }

        return static::$Instance;
    }

    /**
     * Get alias for given type
     * @param mixed $type
     * @throws AliasException
     * @return mixed
     */
    public function get($type)
    {
        if (!$this->exists($type)) {
            throw new AliasException(
                sprintf('Can not get type because alias "%s" not exists', $type)
            );
        }

        return $this->aliases[$type];
    }

    /**
     * Check mixed of alias
     * @param string $type
     * @return bool
     */
    public function exists($type)
    {
        return array_key_exists($type, $this->aliases);
    }

    protected function __clone(){}

    protected function __wakeup(){}

}