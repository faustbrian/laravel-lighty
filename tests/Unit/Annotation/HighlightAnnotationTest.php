<?php

declare(strict_types=1);

namespace Tests\Unit\Annotation;

use BombenProdukt\Lighty\Annotation\HighlightAnnotation;
use BombenProdukt\Lighty\Model\Document;

it('should act correctly based on annotation', function (): void {
    $parser = new HighlightAnnotation(new Document(''));

    expect($parser->shouldAct('highlight'))->toBeTrue();
    expect($parser->shouldAct('nothighlight'))->toBeFalse();
});

it('should parse correctly and highlight modifiers', function (): void {
    $document = new Document('highlight'.\PHP_EOL.'highlight');

    (new HighlightAnnotation($document))->parse($document->getLines()->findByNumber(1), 'highlight', null);
    (new HighlightAnnotation($document))->parse($document->getLines()->findByNumber(2), 'highlight', null);

    expect($document->getLines()->findByNumber(1)->getModifiers())->toEqual(['highlight' => 'highlight']);
    expect($document->getLines()->findByNumber(2)->getModifiers())->toEqual(['highlight' => 'highlight']);
});
