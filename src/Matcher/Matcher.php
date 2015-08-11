<?php
/**
 * Created by PhpStorm.
 * User: funkill
 * Date: 26.06.15
 * Time: 16:28
 */

namespace Matcher;


use Matcher\Exceptions\BadValueException;
use Matcher\Exceptions\TypeInterfaceException;
use Matcher\Types\TypeFactory;

class Matcher
{

    protected static $types = [];

    /**
     * @param mixed $match
     * @param array $handlers
     * @throws BadValueException
     * @throws TypeInterfaceException
     * @return mixed
     */
    public static function match($match, array $handlers)
    {
        $TypeFactory = new TypeFactory();
        foreach ($handlers as $pattern => $closure) {
            $type = $TypeFactory->detect($pattern);
            static::$types[$type][$pattern] = $closure;
        }

        $resultType = $TypeFactory->detect($match);
        if (!array_key_exists($resultType, static::$types)) {
            throw new BadValueException(
                sprintf('Result type `%s` not found', $resultType)
            );
        }

        /**
         * @hint TypeException not handled because it exception throws only if programmer forgot create type
         */
        $Type = $TypeFactory->create($resultType);

        return $Type->match($match, static::$types[$resultType]);
    }

}