<?php

namespace Greeflas\StaticAnalyzer\Model;

/**
 * Quantity class members storage
 */
class QtyClassMembersStorage
{
    public $public;
    public $protected;
    public $private;

    public function __construct(int $public, int $protected, int $private)
    {
        $this->public = $public;
        $this->protected = $protected;
        $this->private = $private;
    }

}