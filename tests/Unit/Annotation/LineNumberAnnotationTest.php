<?php

declare(strict_types=1);

namespace Tests\Unit\Annotation;

use BombenProdukt\Lighty\Annotation\LineNumberAnnotation;
use BombenProdukt\Lighty\Model\Document;

it('should act correctly based on annotation', function (): void {
    $parser = new LineNumberAnnotation(new Document(''));

    expect($parser->shouldAct('lineNumber'))->toBeTrue();
    expect($parser->shouldAct('notlineNumber'))->toBeFalse();
});

it('should parse correctly and lineNumber modifiers', function (): void {
    $document = new Document('lineNumber'.\PHP_EOL.'lineNumber');

    (new LineNumberAnnotation($document))->parse($document->getLines()->findByNumber(1), 'lineNumber(5)', null);
    (new LineNumberAnnotation($document))->parse($document->getLines()->findByNumber(2), 'lineNumber(10)', null);

    expect($document->getLines()->findByNumber(1)->getModifiers())->toBeEmpty();
    expect($document->getLines()->findByNumber(1)->getModifiedNumber())->toEqual(5);
    expect($document->getLines()->findByNumber(2)->getModifiers())->toBeEmpty();
    expect($document->getLines()->findByNumber(2)->getModifiedNumber())->toEqual(10);
});
