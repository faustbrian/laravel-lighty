<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Lighty\CommonMark;

final readonly class CodeBlock implements \Stringable
{
    public function __construct(
        private string $codeBlock,
    ) {}

    public function __toString(): string
    {
        return $this->codeBlock;
    }
}
