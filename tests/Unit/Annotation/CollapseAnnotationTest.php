<?php

declare(strict_types=1);

namespace Tests\Unit\Annotation;

use BombenProdukt\Lighty\Annotation\CollapseAnnotation;
use BombenProdukt\Lighty\Model\Document;

it('should act correctly based on annotation', function (): void {
    $parser = new CollapseAnnotation(new Document(''));

    expect($parser->shouldAct('collapse'))->toBeTrue();
    expect($parser->shouldAct('notcollapse'))->toBeFalse();
});

it('should parse correctly and collapse modifiers', function (): void {
    $document = new Document('collapse'.\PHP_EOL.'collapse');

    (new CollapseAnnotation($document))->parse($document->getLines()->findByNumber(1), 'collapse', null);
    (new CollapseAnnotation($document))->parse($document->getLines()->findByNumber(2), 'collapse', null);

    expect($document->getLines()->findByNumber(1)->getModifiers())->toEqual(['collapse' => 'collapse']);
    expect($document->getLines()->findByNumber(2)->getModifiers())->toEqual(['collapse' => 'collapse']);
});
