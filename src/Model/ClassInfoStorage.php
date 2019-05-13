<?php

/*
 * This file is part of the "PHP Static Analyzer" project.
 *
 * (c) Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Greeflas\StaticAnalyzer\Model;

/**
 * Сlass information storage
 */
final class ClassInfoStorage
{
    public $className;

    public $classType;

    public $properties;

    public $methods;

    public function __construct(string $className, string $classType, array $properties, array $methods)
    {
        $this->className = $className;
        $this->classType = $classType;
        $this->properties = $properties;
        $this->methods = $methods;
    }
}
