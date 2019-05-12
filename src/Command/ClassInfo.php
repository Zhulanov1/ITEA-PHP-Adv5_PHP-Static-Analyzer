<?php

/*
 * This file is part of the "PHP Static Analyzer" project.
 *
 * (c) Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Greeflas\StaticAnalyzer\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Greeflas\StaticAnalyzer\Analyzer\ClassInfo as ClassInfoAnalyzer;

class ClassInfo extends Command
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('class-info')
            ->setDescription('this command shows class information')
            ->addArgument(
                'full class name',
                InputArgument::REQUIRED,
                'the full name of the class information about which we want to get'
            )
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $fullClassName = $input->getArgument('full class name');

        $analyzer = new ClassInfoAnalyzer($fullClassName);

        $result = $analyzer->analyze();

        $output->writeln(\sprintf(
            'Class: %s is %s' . \PHP_EOL
                 . 'Properties:' . \PHP_EOL
                 . '    public: %s' . \PHP_EOL
                 . '    protected: %s' . \PHP_EOL
                 . '    private: %s' . \PHP_EOL
                 . 'Methods:' . \PHP_EOL
                 . '    public: %s' . \PHP_EOL
                 . '    protected: %s' . \PHP_EOL
                 . '    private: %s',
            $result['class_name'],
            $result['class_type'],
            $result['properties']['public'],
            $result['properties']['protected'],
            $result['properties']['private'],
            $result['methods']['public'],
            $result['methods']['protected'],
            $result['methods']['private']
        ));
    }
}
