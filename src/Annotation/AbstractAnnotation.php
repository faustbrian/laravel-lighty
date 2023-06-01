<?php

declare(strict_types=1);

namespace BombenProdukt\Lighty\Annotation;

use BombenProdukt\Lighty\Contract\AnnotationInterface;
use BombenProdukt\Lighty\Model\Document;
use BombenProdukt\Lighty\Model\Line;
use InvalidArgumentException;

abstract class AbstractAnnotation implements AnnotationInterface
{
    private array $pending = [];

    public function __construct(protected readonly Document $document) {}

    abstract public function parse(Line $line, string $annotation, ?string $arguments): void;

    protected function findByNumber(int $lineNumber): Line
    {
        return $this->document->getLines()->findByNumber($lineNumber);
    }

    protected function parseRange(int $lineNumber, ?string $arguments): array
    {
        if (empty($arguments)) {
            return \range($lineNumber, $lineNumber);
        }

        $arguments = \explode(',', $arguments);

        if ($arguments[0] === 'start') {
            $this->pending[] = $lineNumber;

            return [];
        }

        if ($arguments[0] === 'end') {
            if (empty($this->pending)) {
                throw new InvalidArgumentException('Invalid highlight argument.');
            }

            $result = \range($this->pending[0], $lineNumber);

            $this->pending = [];

            return $result;
        }

        if (\count($arguments) === 1) {
            $lineCount = (int) $arguments[0];

            if ($lineCount < 0) {
                return \range($lineNumber + $lineCount, $lineNumber);
            }

            return \range($lineNumber, $lineNumber + $lineCount);
        }

        if (\count($arguments) === 2) {
            $startLine = \abs($arguments[0] + 1);

            return \range($startLine, $startLine + $arguments[1] - 1);
        }

        throw new InvalidArgumentException('Invalid highlight argument.');
    }
}
