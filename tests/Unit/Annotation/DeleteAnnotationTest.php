<?php

declare(strict_types=1);

namespace Tests\Unit\Annotation;

use BombenProdukt\Lighty\Annotation\DeleteAnnotation;
use BombenProdukt\Lighty\Model\Document;

it('should act correctly based on annotation', function (): void {
    $parser = new DeleteAnnotation(new Document(''));

    expect($parser->shouldAct('delete'))->toBeTrue();
    expect($parser->shouldAct('notdelete'))->toBeFalse();
});

it('should parse correctly and delete modifiers', function (): void {
    $document = new Document('delete'.\PHP_EOL.'delete');

    (new DeleteAnnotation($document))->parse($document->getLines()->findByNumber(1), 'delete', null);
    (new DeleteAnnotation($document))->parse($document->getLines()->findByNumber(2), 'delete', null);

    expect($document->getLines()->findByNumber(1)->getModifiers())->toEqual(['delete' => 'delete']);
    expect($document->getLines()->findByNumber(2)->getModifiers())->toEqual(['delete' => 'delete']);
});
