<?php

declare(strict_types=1);

namespace BaseCodeOy\Lighty\Repository;

use BaseCodeOy\Lighty\Model\Line;
use Illuminate\Support\Collection;

final readonly class LineRepository
{
    /**
     * @var Collection<string, Line>
     */
    private Collection $lines;

    public function __construct(array $lines)
    {
        $this->lines = collect($lines)->map(fn (string $value, int $index): Line => new Line($index + 1, $value, []));
    }

    /**
     * @return Collection<string, Line>
     */
    public function all(): Collection
    {
        return $this->lines;
    }

    public function add(Line $line): void
    {
        $this->lines->push($line);
    }

    public function findByNumber(int $number): ?Line
    {
        return $this->lines->firstWhere(fn (Line $line) => $line->getOriginalNumber() === $number);
    }

    public function count(): int
    {
        return $this->lines->count();
    }

    public function toArray(): array
    {
        return $this
            ->lines
            ->keyBy(fn (Line $line) => $line->getOriginalNumber())
            ->toArray();
    }
}
