<?php

declare(strict_types=1);

namespace Tests\Unit\Annotation;

use BombenProdukt\Lighty\Annotation\LinkifyAnnotation;
use BombenProdukt\Lighty\Model\Document;

it('should act correctly based on annotation', function (): void {
    $parser = new LinkifyAnnotation(new Document(''));

    expect($parser->shouldAct('linkify'))->toBeTrue();
    expect($parser->shouldAct('notlinkify'))->toBeFalse();
});

it('should parse correctly and linkify modifiers', function (): void {
    $document = new Document('linkify'.\PHP_EOL.'linkify');

    (new linkifyAnnotation($document))->parse($document->getLines()->findByNumber(1), 'linkify', null);
    (new linkifyAnnotation($document))->parse($document->getLines()->findByNumber(2), 'linkify', null);

    expect($document->getLines()->findByNumber(1)->getModifiers())->toEqual(['linkify' => 'linkify']);
    expect($document->getLines()->findByNumber(2)->getModifiers())->toEqual(['linkify' => 'linkify']);
});
