<?php
/**
 * Created by PhpStorm.
 * User: funkill
 * Date: 07.07.15
 * Time: 18:29
 */

namespace Matcher\Types;


use Matcher\Exceptions\BadValueException;

class Object implements TypeInterface
{

    /**
     * @param mixed $match
     * @param array $handlers
     * @throws BadValueException
     * @return mixed
     */
    public function match($match, array $handlers)
    {
        $class = get_class($match);
        if (array_key_exists($class, $handlers)) {
            return $handlers[$class]($match);
        }

        foreach ($handlers as $pattern => $closure) {
            if ($match instanceof $pattern) {
                return $closure($match);
            }
        }

        throw new BadValueException('Value not found');
    }

}