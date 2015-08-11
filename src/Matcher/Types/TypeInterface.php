<?php
/**
 * Created by PhpStorm.
 * User: funkill
 * Date: 06.07.15
 * Time: 19:19
 */

namespace Matcher\Types;


use Matcher\Exceptions\BadValueException;

interface TypeInterface
{

    /**
     * @param mixed $match
     * @param array $handlers
     * @throws BadValueException
     * @return mixed
     */
    public function match($match, array $handlers);

}