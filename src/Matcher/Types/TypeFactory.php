<?php
/**
 * Created by PhpStorm.
 * User: funkill
 * Date: 06.07.15
 * Time: 19:21
 */

namespace Matcher\Types;


use Matcher\Exceptions\TypeInterfaceException;
use Matcher\Exceptions\TypeNotFoundException;

class TypeFactory
{

    /**
     * @param $type
     * @throws TypeInterfaceException
     * @throws TypeNotFoundException
     * @return TypeInterface
     */
    public function create($type)
    {
        // Check type aliases
        if (Aliases::instance()->exists($type)) {
            $type = Aliases::instance()->get($type);
        }

        if (!class_exists($type, true)) {
            throw new TypeNotFoundException(
                sprintf('Type `%s` not found', $type)
            );
        }

        $object = new $type();

        if (!($object instanceof TypeInterface)) {
            throw new TypeInterfaceException(
                sprintf('Class "%s" not implements interface TypeInterface', $type)
            );
        }

        return $object;
    }

    public function detect($object)
    {
        $type = gettype($object);
        if ($type === 'string' && class_exists($object, true)) {
            $type = 'object';
        }

        return $type;
    }

}