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

/**
 * This command shows class information in format:
 * Class: {{class_name}} is {{class_type}}
 * Properties:
 *     public: {{count}}
 *     protected: {{count}}
 *     private: {{count}}
 * Methods:
 *     public: {{count}}
 *     protected: {{count}}
 *     private: {{count}}
 *
 * @author Konstantin Zhulanov <zhulanov111@gmail.com>
 */
final class ClassInfo
{
    private $fullClassName;

    /**
     * ClassInfo constructor.
     *
     * @param string $fullClassName
     */
    public function __construct(string $fullClassName)
    {
        $this->fullClassName = $fullClassName;
    }

    /**
     * @throws \ReflectionException
     *
     * @return array
     */
    public function analyze()
    {
        $reflector = new \ReflectionClass($this->fullClassName);

        $result = [];

        $result['class_name'] = $reflector->getShortName();
        $result['class_type'] = $this->getClassType($reflector);
        $result['properties'] = $this->getQtyProperties($reflector);
        $result['methods'] = $this->getQtyMethods($reflector);

        return $result;
    }

    /**
     * @param \ReflectionClass $reflector
     *
     * @return string
     */
    private function getClassType(\ReflectionClass $reflector): string
    {
        if ($reflector->isFinal()) {
            return 'final';
        }

        if ($reflector->isAbstract()) {
            return 'abstract';
        }

        return 'normal';
    }


    /**
     * @param \ReflectionClass $reflector
     *
     * @return array
     */
    private function getQtyMethods(\ReflectionClass $reflector): array
    {
        $result = [];

        $result['public'] = \count($reflector->getMethods(\ReflectionMethod::IS_PUBLIC));
        $result['protected'] = \count($reflector->getMethods(\ReflectionMethod::IS_PROTECTED));
        $result['private'] = \count($reflector->getMethods(\ReflectionMethod::IS_PRIVATE));

        return $result;
    }

    /**
     * @param \ReflectionClass $reflector
     *
     * @return array
     */
    private function getQtyProperties(\ReflectionClass $reflector): array
    {
        $result = [];

        $result['public'] = \count($reflector->getProperties(\ReflectionProperty::IS_PUBLIC));
        $result['protected'] = \count($reflector->getProperties(\ReflectionProperty::IS_PROTECTED));
        $result['private'] = \count($reflector->getProperties(\ReflectionProperty::IS_PRIVATE));

        return $result;
    }
}
