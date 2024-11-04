<?php

declare(strict_types=1);

namespace BaseCodeOy\Lighty\Model;

use BaseCodeOy\Lighty\Repository\LineRepository;
use Illuminate\Support\Facades\Config;

final class Document
{
    private LineRepository $lines;

    private bool $skipLineParsing = false;

    private bool $showDiffIndicators = true;

    private bool $showDiffIndicatorsInPlaceOfLineNumbers = true;

    private bool $showLineNumbers = true;

    private array|string $language;

    private array|string $theme;

    public function __construct(private string $code)
    {
        $this->lines = new LineRepository(\explode(\PHP_EOL, $code));
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    public function getSanitizedCode(): string
    {
        if ($this->skipLineParsing) {
            return $this->code;
        }

        $code = $this->code;

        if (\str_starts_with($code, '// lighty')) {
            $lines = \explode(\PHP_EOL, $code);

            \array_shift($lines);

            $code = \implode(\PHP_EOL, $lines);
        }

        return \preg_replace(Config::get('lighty.regexp'), '', $code);
    }

    public function getSkipLineParsing(): bool
    {
        return $this->skipLineParsing;
    }

    public function setSkipLineParsing(bool $skipLineParsing): void
    {
        $this->skipLineParsing = $skipLineParsing;
    }

    public function getLines(): LineRepository
    {
        return $this->lines;
    }

    public function setLines(string $code): void
    {
        $this->lines = new LineRepository(\explode(\PHP_EOL, $code));
    }

    public function getLanguage(): array|string
    {
        return $this->language;
    }

    public function setLanguage(array|string $language): void
    {
        $this->language = $language;
    }

    public function getTheme(): array|string
    {
        return $this->theme;
    }

    public function setTheme(array|string $theme): void
    {
        $this->theme = $theme;
    }

    public function getShowDiffIndicators(): bool
    {
        return $this->showDiffIndicators;
    }

    public function showDiffIndicators(): void
    {
        $this->showDiffIndicators = true;
    }

    public function hideDiffIndicators(): void
    {
        $this->showDiffIndicators = false;
    }

    public function getShowDiffIndicatorsInPlaceOfLineNumbers(): bool
    {
        return $this->showDiffIndicatorsInPlaceOfLineNumbers;
    }

    public function showDiffIndicatorsInPlaceOfLineNumbers(): void
    {
        $this->showDiffIndicatorsInPlaceOfLineNumbers = true;
    }

    public function hideDiffIndicatorsInPlaceOfLineNumbers(): void
    {
        $this->showDiffIndicatorsInPlaceOfLineNumbers = false;
    }

    public function getShowLineNumbers(): bool
    {
        return $this->showLineNumbers;
    }

    public function showLineNumbers(): void
    {
        $this->showLineNumbers = true;
    }

    public function hideLineNumbers(): void
    {
        $this->showLineNumbers = false;
    }

    public function hash(): string
    {
        return \hash('sha256', \json_encode($this->toArray()));
    }

    public function toArray(): array
    {
        return [
            'code' => $this->getCode(),
            'codeSanitized' => $this->getSanitizedCode(),
            'lines' => $this->lines->toArray(),
            'showDiffIndicators' => $this->showDiffIndicators,
            'showDiffIndicatorsInPlaceOfLineNumbers' => $this->showDiffIndicatorsInPlaceOfLineNumbers,
            'showLineNumbers' => $this->showLineNumbers,
        ];
    }
}
