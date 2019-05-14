<?php

/*
 * This file is part of the "PHP Static Analyzer" project.
 *
 * (c) Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Greeflas\StaticAnalyzer\Analyzer;

use Greeflas\StaticAnalyzer\Model\ClassInfoStorage;
use Greeflas\StaticAnalyzer\Model\QtyClassMembersStorage;

/**
 * Analyzer collects information about the class
 * @author Konstantin Zhulanov <zhulanov111@gmail.com>
 */
final class ClassInfo
{
    const CLASS_TYPE_FINAL = 'final';
    const CLASS_TYPE_ABSTRACT = 'abstract';
    const CLASS_TYPE_NORMAL = 'normal';

    private $fullClassName;

    public function __construct(string $fullClassName)
    {
        $this->fullClassName = $fullClassName;
    }

    /**
     * @throws \ReflectionException
     *
     * @return ClassInfoStorage
     */
    public function analyze(): ClassInfoStorage
    {
        try {
            $reflector = new \ReflectionClass($this->fullClassName);
        } catch (\ReflectionException $e) {
            throw new \InvalidArgumentException(\sprintf('Class %s not found, check your input', $this->fullClassName));
        }

        return new ClassInfoStorage(
            $reflector->getShortName(),
            $this->getClassType($reflector),
            $this->getQtyProperties($reflector),
            $this->getQtyMethods($reflector)
        );
    }

    /**
     * @param \ReflectionClass $reflector
     *
     * @return string
     */
    private function getClassType(\ReflectionClass $reflector): string
    {
        if ($reflector->isFinal()) {
            return self::CLASS_TYPE_FINAL;
        }

        if ($reflector->isAbstract()) {
            return self::CLASS_TYPE_ABSTRACT;
        }

        return self::CLASS_TYPE_NORMAL;
    }


    /**
     * @param \ReflectionClass $reflector
     *
     * @return QtyClassMembersStorage
     */
    private function getQtyMethods(\ReflectionClass $reflector): QtyClassMembersStorage
    {
        return new QtyClassMembersStorage(
            \count($reflector->getMethods(\ReflectionMethod::IS_PUBLIC)),
            \count($reflector->getMethods(\ReflectionMethod::IS_PROTECTED)),
            \count($reflector->getMethods(\ReflectionMethod::IS_PRIVATE))
        );
    }

    /**
     * @param \ReflectionClass $reflector
     *
     * @return QtyClassMembersStorage
     */
    private function getQtyProperties(\ReflectionClass $reflector): QtyClassMembersStorage
    {
        return new QtyClassMembersStorage(
            \count($reflector->getProperties(\ReflectionProperty::IS_PUBLIC)),
            \count($reflector->getProperties(\ReflectionProperty::IS_PROTECTED)),
            \count($reflector->getProperties(\ReflectionProperty::IS_PRIVATE))
        );
    }
}
