<?php

declare(strict_types=1);

namespace BombenProdukt\Lighty\Extension;

final class DiscoverGrammars
{
    /**
     * @return Grammar[]
     */
    public static function execute(Extension $extension): array
    {
        $grammars = [];

        foreach (ParsePackageJson::execute($extension, 'grammars') as $grammar) {
            if (!\str_starts_with($grammar['scopeName'], 'source.')) {
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
