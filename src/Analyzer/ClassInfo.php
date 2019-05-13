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

/**
 * Analyzer collects information about the class and returns it in the format:
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
    const FINAL_CLASS_TYPE = 'final';

    const ABSTRACT_CLASS_TYPE = 'abstract';

    const NORMAL_CLASS_TYPE = 'normal';

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
            die(\sprintf('Class %s not found, check your input' . \PHP_EOL, $this->fullClassName));
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
            return self::FINAL_CLASS_TYPE;
        }

        if ($reflector->isAbstract()) {
            return self::ABSTRACT_CLASS_TYPE;
        }

        return self::NORMAL_CLASS_TYPE;
    }


    /**
     * @param \ReflectionClass $reflector
     *
     * @return array
     */
    private function getQtyMethods(\ReflectionClass $reflector): array
    {
        return ['public' => \count($reflector->getMethods(\ReflectionMethod::IS_PUBLIC)),
                'protected' => \count($reflector->getMethods(\ReflectionMethod::IS_PROTECTED)),
                'private' => \count($reflector->getMethods(\ReflectionMethod::IS_PRIVATE)), ];
    }

    /**
     * @param \ReflectionClass $reflector
     *
     * @return array
     */
    private function getQtyProperties(\ReflectionClass $reflector): array
    {
        return ['public' => \count($reflector->getProperties(\ReflectionProperty::IS_PUBLIC)),
                'protected' => \count($reflector->getProperties(\ReflectionProperty::IS_PROTECTED)),
                'private' => \count($reflector->getProperties(\ReflectionProperty::IS_PRIVATE)), ];
    }
}
