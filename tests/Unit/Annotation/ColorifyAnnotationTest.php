<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Tests\Unit\Annotation;

use BaseCodeOy\Lighty\Annotation\ColorifyAnnotation;
use BaseCodeOy\Lighty\Model\Document;

it('should act correctly based on annotation', function (): void {
    $parser = new ColorifyAnnotation(new Document(''));

    expect($parser->shouldAct('colorify'))->toBeTrue();
    expect($parser->shouldAct('notcolorify'))->toBeFalse();
});

it('should parse correctly and colorify modifiers', function (): void {
    $document = new Document('#a5dd12'.\PHP_EOL.'#ff55ff');

    (new ColorifyAnnotation($document))->parse($document->getLines()->findByNumber(1), 'colorify', null);
    (new ColorifyAnnotation($document))->parse($document->getLines()->findByNumber(2), 'colorify', null);

    expect($document->getLines()->findByNumber(1)->getModifiers())->toEqual(['colorify' => 'colorify']);
    expect($document->getLines()->findByNumber(2)->getModifiers())->toEqual(['colorify' => 'colorify']);
});
