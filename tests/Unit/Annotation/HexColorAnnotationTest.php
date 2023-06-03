<?php

declare(strict_types=1);

namespace Tests\Unit\Annotation;

use BombenProdukt\Lighty\Annotation\HexColorAnnotation;
use BombenProdukt\Lighty\Model\Document;

it('should act correctly based on annotation', function (): void {
    $parser = new HexColorAnnotation(new Document(''));

    expect($parser->shouldAct('hex-color'))->toBeTrue();
    expect($parser->shouldAct('nothex-color'))->toBeFalse();
});

it('should parse correctly and hex-color modifiers', function (): void {
    $document = new Document('#a5dd12'.\PHP_EOL.'#ff55ff');

    (new HexColorAnnotation($document))->parse($document->getLines()->findByNumber(1), 'hex-color', null);
    (new HexColorAnnotation($document))->parse($document->getLines()->findByNumber(2), 'hex-color', null);

    expect($document->getLines()->findByNumber(1)->getModifiers())->toEqual(['hex-color' => 'hex-color']);
    expect($document->getLines()->findByNumber(2)->getModifiers())->toEqual(['hex-color' => 'hex-color']);
});
