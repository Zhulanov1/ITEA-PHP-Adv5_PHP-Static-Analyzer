<?php

/*
 * This file is part of the "PHP Static Analyzer" project.
 *
 * (c) Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Greeflas\StaticAnalyzer\Test;

class A
{
    public $a;
    protected $b;
    private $c;

    public static $aa;
    protected static $bb;
    private static $cc;

    public function a()
    {
    }

    protected function b()
    {
    }

    private function c()
    {
    }

    public static function aa()
    {
    }

    private static function bb()
    {
    }

    protected static function cc()
    {
    }
}
