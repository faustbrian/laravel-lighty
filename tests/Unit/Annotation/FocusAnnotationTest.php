<?php

declare(strict_types=1);

namespace Tests\Unit\Annotation;

use BombenProdukt\Lighty\Annotation\FocusAnnotation;
use BombenProdukt\Lighty\Model\Document;

it('should act correctly based on annotation', function (): void {
    $parser = new FocusAnnotation(new Document(''));

    expect($parser->shouldAct('focus'))->toBeTrue();
    expect($parser->shouldAct('notfocus'))->toBeFalse();
});

it('should parse correctly and focus modifiers', function (): void {
    $document = new Document('focus'.\PHP_EOL.'focus');

    (new FocusAnnotation($document))->parse($document->getLines()->findByNumber(1), 'focus', null);
    (new FocusAnnotation($document))->parse($document->getLines()->findByNumber(2), 'focus', null);

    expect($document->getLines()->findByNumber(1)->getModifiers())->toEqual(['focus' => 'focus']);
    expect($document->getLines()->findByNumber(2)->getModifiers())->toEqual(['focus' => 'focus']);
});
