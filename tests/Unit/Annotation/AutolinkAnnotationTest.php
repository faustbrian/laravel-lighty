<?php

declare(strict_types=1);

namespace Tests\Unit\Annotation;

use BombenProdukt\Lighty\Annotation\AutolinkAnnotation;
use BombenProdukt\Lighty\Model\Document;

it('should act correctly based on annotation', function (): void {
    $parser = new AutolinkAnnotation(new Document(''));

    expect($parser->shouldAct('autolink'))->toBeTrue();
    expect($parser->shouldAct('notautolink'))->toBeFalse();
});

it('should parse correctly and autolink modifiers', function (): void {
    $document = new Document('autolink'.\PHP_EOL.'autolink');

    (new AutolinkAnnotation($document))->parse($document->getLines()->findByNumber(1), 'autolink', null);
    (new AutolinkAnnotation($document))->parse($document->getLines()->findByNumber(2), 'autolink', null);

    expect($document->getLines()->findByNumber(1)->getModifiers())->toEqual(['autolink' => 'autolink']);
    expect($document->getLines()->findByNumber(2)->getModifiers())->toEqual(['autolink' => 'autolink']);
});
