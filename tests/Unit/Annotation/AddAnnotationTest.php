<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Tests\Unit\Annotation;

use BaseCodeOy\Lighty\Annotation\AddAnnotation;
use BaseCodeOy\Lighty\Model\Document;

it('should act correctly based on annotation', function (): void {
    $parser = new AddAnnotation(new Document(''));

    expect($parser->shouldAct('add'))->toBeTrue();
    expect($parser->shouldAct('notadd'))->toBeFalse();
});

it('should parse correctly and add modifiers', function (): void {
    $document = new Document('add'.\PHP_EOL.'add');

    (new AddAnnotation($document))->parse($document->getLines()->findByNumber(1), 'add', null);
    (new AddAnnotation($document))->parse($document->getLines()->findByNumber(2), 'add', null);

    expect($document->getLines()->findByNumber(1)->getModifiers())->toEqual(['add' => 'add']);
    expect($document->getLines()->findByNumber(2)->getModifiers())->toEqual(['add' => 'add']);
});
