<?php

declare(strict_types=1);

namespace BombenProdukt\Lighty\Model;

use Spatie\LaravelData\Data;

final class Line extends Data
{
    public function __construct(
        private int $originalNumber,
        private string $content,
        private array $modifiers,
        private ?int $modifiedNumber = null,
    ) {}

    public function getOriginalNumber(): int
    {
        return $this->originalNumber;
    }

    public function setOriginalNumber(int|string $originalNumber): void
    {
        $this->originalNumber = (int) $originalNumber;
    }

    public function getModifiedNumber(): int
    {
        return $this->modifiedNumber;
    }

    public function setModifiedNumber(int|string $modifiedNumber): void
    {
        $this->modifiedNumber = (int) $modifiedNumber;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): void
    {
        $this->content = $content;
    }

    public function getModifiers(): ?array
    {
        return $this->modifiers;
    }

    public function setModifiers(?array $modifiers): void
    {
        $this->modifiers = $modifiers;
    }

    public function addModifier(string $key): void
    {
        $this->modifiers[$key] = $key;
    }

    public function appendModifier(string $key, string $value): void
    {
        $this->modifiers[$key][] = $value;
    }

    public function getSanitizedContent(): string
    {
        return \preg_replace('/\{lighty\s(.+?)\}/', '', $this->getContent());
    }

    public function toArray(): array
    {
        return [
            'originalNumber' => $this->originalNumber,
            'modifiedNumber' => $this->modifiedNumber ?? $this->originalNumber,
            'content' => $this->content,
            'modifiers' => $this->modifiers,
        ];
    }
}
