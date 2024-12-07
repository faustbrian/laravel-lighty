<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Lighty\Annotation;

use BaseCodeOy\Lighty\Model\Line;
use Illuminate\Support\Str;

final class LineNumberAnnotation extends AbstractAnnotation
{
    #[\Override()]
    public function shouldAct(string $annotation): bool
    {
        return Str::startsWith($annotation, ['lineNumber', 'reindex']);
    }

    #[\Override()]
    public function parse(Line $line, string $annotation, ?string $arguments): void
    {
        $modifier = \mb_substr(\explode('(', $annotation)[1], 0, -1);

        foreach ($this->parseRange($line->getOriginalNumber(), $arguments) as $lineNumber) {
            match (true) {
                \str_starts_with($modifier, '+') => $this->increment($lineNumber, $modifier),
                \str_starts_with($modifier, '-') => $this->decrement($lineNumber, $modifier),
                $modifier === 'null' => $this->set($lineNumber, '0'),
                default => $this->set($lineNumber, $modifier),
            };
        }
    }

    private function set(int $lineNumber, string $modifier): void
    {
        $this->findByNumber($lineNumber)->setModifiedNumber($this->abs($modifier));
    }

    private function increment(int $lineNumber, string $modifier): void
    {
        $line = $this->findByNumber($lineNumber);
        $line->setModifiedNumber($line->getOriginalNumber() + $this->abs($modifier));
    }

    private function decrement(int $lineNumber, string $modifier): void
    {
        $line = $this->findByNumber($lineNumber);
        $line->setModifiedNumber($line->getOriginalNumber() - $this->abs($modifier));
    }

    private function abs(string $modifier): int
    {
        return \abs((int) $modifier);
    }
}
