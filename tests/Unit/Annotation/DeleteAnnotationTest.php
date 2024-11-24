<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Tests\Unit\Annotation;

use BaseCodeOy\Lighty\Annotation\DeleteAnnotation;
use BaseCodeOy\Lighty\Model\Document;

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
