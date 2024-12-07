<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Lighty\Extension;

final class DiscoverGrammars
{
    /**
     * @return array<Grammar>
     */
    public static function execute(Extension $extension): array
    {
        $grammars = [];

        foreach (ParsePackageJson::execute($extension, 'grammars') as $grammar) {
            if (!\str_starts_with((string) $grammar['scopeName'], 'source.')) {
                continue;
            }

            $grammars[] = new Grammar(
                language: $grammar['language'],
                scope: $grammar['scopeName'],
                path: Path::normalize($extension, $grammar['path']),
            );
        }

        return $grammars;
    }
}
