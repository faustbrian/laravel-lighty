<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Lighty\Parser;

use BaseCodeOy\Lighty\Contract\AnnotationInterface;
use BaseCodeOy\Lighty\Model\Document;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;

final class DocumentParser
{
    public function parse(string $code): Document
    {
        $document = $this->createDocument($code);

        /** @var array<AnnotationInterface> */
        $parsers = collect(Config::get('lighty.annotations'))
            ->map(fn (string $parser) => new $parser($document))
            ->toArray();

        $this->parseOptions($document);

        if ($document->getSkipLineParsing()) {
            $document->setLines($document->getCode());

            return $document;
        }

        foreach ($document->getLines()->all() as $line) {
            \preg_match(Config::get('lighty.regexp'), $line->getContent(), $matches);

            if (\array_key_exists(1, $matches)) {
                $segments = \explode(' ', $matches[1]);

                foreach ($segments as $segment) {
                    $annotationSegments = \explode(':', $segment, 2);
                    $annotation = $annotationSegments[0];

                    if (\array_key_exists(1, $annotation)) {
                        $arguments = $annotationSegments[1] ?? null;
                    }

                    if (isset($annotation)) {
                        foreach ($parsers as $parser) {
                            if ($parser->shouldAct($annotation)) {
                                $parser->parse($line, $annotation, $arguments);
                            }
                        }
                    }
                }
            }
        }

        return $document;
    }

    private function createDocument(string $code): Document
    {
        $document = new Document(\htmlspecialchars_decode($code));

        if (Config::has('lighty.language')) {
            $document->setLanguage(Config::get('lighty.language'));
        }

        if (Config::has('lighty.theme')) {
            $document->setTheme(Config::get('lighty.theme'));
        }

        if (Config::get('lighty.showLineNumbers') === true) {
            $document->showLineNumbers();
        }

        if (Config::get('lighty.showDiffIndicators') === true) {
            $document->showDiffIndicators();
        }

        if (Config::get('lighty.showDiffIndicatorsInPlaceOfLineNumbers') === true) {
            $document->showDiffIndicatorsInPlaceOfLineNumbers();
        }

        return $document;
    }

    private function parseOptions(Document $document): void
    {
        $line = $document->getLines()->all()->first()->getContent();

        if (!\str_starts_with($line, '// lighty')) {
            return;
        }

        $options = \json_decode(\str_replace('// lighty', '', $line), true, 512, \JSON_THROW_ON_ERROR);

        if (Arr::get($options, 'skipLineParsing') === true) {
            $document->setSkipLineParsing(true);
        }

        if (Arr::has($options, 'language')) {
            $document->setLanguage(Arr::get($options, 'language'));
        }

        if (Arr::has($options, 'theme')) {
            $document->setTheme(Arr::get($options, 'theme'));
        }

        if (Arr::get($options, 'showLineNumbers') === true) {
            $document->showLineNumbers();
        }

        if (Arr::get($options, 'showLineNumbers') === false) {
            $document->hideLineNumbers();
        }

        if (Arr::get($options, 'showDiffIndicators') === true) {
            $document->showDiffIndicators();
        }

        if (Arr::get($options, 'showDiffIndicators') === false) {
            $document->hideDiffIndicators();
        }

        if (Arr::get($options, 'showDiffIndicatorsInPlaceOfLineNumbers') === true) {
            $document->showDiffIndicatorsInPlaceOfLineNumbers();
        }

        if (Arr::get($options, 'showDiffIndicatorsInPlaceOfLineNumbers') === false) {
            $document->hideDiffIndicatorsInPlaceOfLineNumbers();
        }

        $this->setLinesWithoutOptions($document);
    }

    private function setLinesWithoutOptions(Document $document): void
    {
        $code = $document->getCode();

        if (\str_starts_with($code, '// lighty')) {
            $lines = \explode(\PHP_EOL, $code);

            \array_shift($lines);

            $code = \implode(\PHP_EOL, $lines);
        }

        $document->setLines($code);
    }
}
