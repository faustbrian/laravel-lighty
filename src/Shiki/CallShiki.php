<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Lighty\Shiki;

use Illuminate\Support\Facades\Process;
use Symfony\Component\Process\ExecutableFinder;

final class CallShiki
{
    public static function execute(string $file, array $arguments = []): string
    {
        $processResult = Process::path(self::getWorkingDirectory())->run([
            (new ExecutableFinder())->find('node', 'node', [
                '/usr/local/bin',
                '/opt/homebrew/bin',
            ]),
            $file,
            \json_encode(\array_values($arguments), \JSON_THROW_ON_ERROR),
        ]);

        if ($processResult->failed()) {
            throw new \RuntimeException($processResult->errorOutput(), $processResult->exitCode());
        }

        return $processResult->output();
    }

    private static function getWorkingDirectory(): string
    {
        return __DIR__.'/../../bin';
    }
}
