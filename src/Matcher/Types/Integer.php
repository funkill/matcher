<?php
/**
 * Created by PhpStorm.
 * User: funkill
 * Date: 06.07.15
 * Time: 19:18
 */

namespace Matcher\Types;


use Matcher\Exceptions\BadValueException;

class Integer implements TypeInterface
{

    /**
     * @param mixed $match
     * @param array $handlers
     * @throws BadValueException
     * @return mixed
     */
    public function match($match, array $handlers)
    {
        if (!array_key_exists($match, $handlers)) {
            throw new BadValueException(
                sprintf('Value `%d` not found', $match)
            );
        }

        return $handlers[$match]($match);
    }

}