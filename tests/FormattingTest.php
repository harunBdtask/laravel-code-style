<?php

declare(strict_types=1);

namespace Jubeki\LaravelCodeStyle;

use PhpCsFixer\Console\Application;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;

class FormattingTest extends TestCase
{
    public function test_formatting_matches_laravel()
    {
        $application = tap(new Application())->setAutoExit(false);
        $exitCode = $application->run(
            new ArrayInput([
                'command' => 'fix',
                'path' => [__DIR__.'/../laravel'],
                '--config' => __DIR__.'/fixtures/.php-cs-fixer.dist.php',
                '--dry-run' => true,
                '--diff' => true,
                '--verbose' => true,
            ]),
            $output = new BufferedOutput()
        );

        $this->assertEquals(
            0,
            $exitCode,
            implode(PHP_EOL, [
                'Existing Laravel files should not need to be fixed.',
                'Output:',
                $output->fetch(),
            ])
        );
    }
}
