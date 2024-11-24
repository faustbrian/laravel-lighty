<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Tests\Unit\Annotation;

use BaseCodeOy\Lighty\Annotation\LinkifyAnnotation;
use BaseCodeOy\Lighty\Model\Document;

it('should act correctly based on annotation', function (): void {
    $parser = new LinkifyAnnotation(new Document(''));

    expect($parser->shouldAct('linkify'))->toBeTrue();
    expect($parser->shouldAct('notlinkify'))->toBeFalse();
});

it('should parse correctly and linkify modifiers', function (): void {
    $document = new Document('linkify'.\PHP_EOL.'linkify');

    (new LinkifyAnnotation($document))->parse($document->getLines()->findByNumber(1), 'linkify', null);
    (new LinkifyAnnotation($document))->parse($document->getLines()->findByNumber(2), 'linkify', null);

    expect($document->getLines()->findByNumber(1)->getModifiers())->toEqual(['linkify' => 'linkify']);
    expect($document->getLines()->findByNumber(2)->getModifiers())->toEqual(['linkify' => 'linkify']);
});
