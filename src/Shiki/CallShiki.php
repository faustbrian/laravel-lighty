<?php

declare(strict_types=1);

namespace BaseCodeOy\Lighty\Shiki;

use Illuminate\Support\Facades\Process;
use RuntimeException;
use Symfony\Component\Process\ExecutableFinder;

final class CallShiki
{
    public static function execute(string $file, array $arguments = []): string
    {
        $process = Process::path(self::getWorkingDirectory())->run([
            (new ExecutableFinder())->find('node', 'node', [
                '/usr/local/bin',
                '/opt/homebrew/bin',
            ]),
            $file,
            \json_encode(\array_values($arguments), \JSON_THROW_ON_ERROR),
        ]);

        if ($process->failed()) {
            throw new RuntimeException($process->errorOutput(), $process->exitCode());
        }

        return $process->output();
    }

    private static function getWorkingDirectory(): string
    {
        return __DIR__.'/../../bin';
    }
}
