<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Tests\Unit\Parser;

use BaseCodeOy\Lighty\Parser\DocumentParser;

it('should parse annotations (Single Line)', function (string $type): void {
    assertMatchesDocumentSnapshot(<<<"CODE"
    return [
        'extensions' => [ // [lighty {$type}]
            // Add attributes straight from markdown.
            AttributesExtension::class,
            // Add Lighty syntax highlighting.
            LightyExtension::class,
        ]
    ]
CODE);
})->with(['add', 'collapse', 'delete', 'focus', 'highlight']);

it('should parse annotations (Start and End)', function (string $type): void {
    assertMatchesDocumentSnapshot(<<<"CODE"
return [
    'heading_permalink' => [ [lighty {$type}:start]
        'html_class' => 'permalink',
        'id_prefix' => 'user-content',
        'insert' => 'before',
        'title' => 'Permalink',
        'symbol' => '#',
    ],[lighty {$type}:end]

    'extensions' => [
        // Add attributes straight from markdown.
        AttributesExtension::class,
        // Add Lighty syntax highlighting.
        LightyExtension::class,
    ]
]
CODE);
})->with(['add', 'collapse', 'delete', 'focus', 'highlight']);

it('should parse annotations (N-Many Lines)', function (string $type): void {
    assertMatchesDocumentSnapshot(<<<"CODE"
return [
    'heading_permalink' => [ [lighty {$type}:2]
        'html_class' => 'permalink',
        'id_prefix' => 'user-content',
        'insert' => 'before',
        'title' => 'Permalink',
        'symbol' => '#',
    ],

    'extensions' => [
        // Add attributes straight from markdown.
        AttributesExtension::class,
        // Add Lighty syntax highlighting.
        LightyExtension::class,
    ]
]
CODE);
})->with(['add', 'collapse', 'delete', 'focus', 'highlight']);

it('should parse annotations (Offset and Length)', function (string $type): void {
    assertMatchesDocumentSnapshot(<<<"CODE"
return [
    'heading_permalink' => [ [lighty {$type}:6,3]
        'html_class' => 'permalink',
        'id_prefix' => 'user-content',
        'insert' => 'before',
        'title' => 'Permalink',
        'symbol' => '#',
    ],

    'extensions' => [
        // Add attributes straight from markdown.
        AttributesExtension::class,
        // Add Lighty syntax highlighting.
        LightyExtension::class,
    ]
]
CODE);
})->with(['add', 'collapse', 'delete', 'focus', 'highlight']);

it('should parse annotations with ids and classes', function (string $type): void {
    assertMatchesDocumentSnapshot(<<<"CODE"
return [
    'extensions' => [
        // Add attributes straight from markdown.
        AttributesExtension::class,
        // Add Lighty syntax highlighting.[lighty {$type} .animate-pulse]
        LightyExtension::class,[lighty {$type} .font-bold .italic .animate-pulse #pulse]
    ]
]
CODE);
})->with(['add', 'collapse', 'delete', 'focus', 'highlight']);

it('should parse linkify annotations', function (): void {
    assertMatchesDocumentSnapshot(<<<'CODE'
/**
 * @see https://bit.ly/2UMUsiu. [lighty linkify]
 */
{$link} = 'https://bit.ly/2UMUsiu' [lighty linkify]
CODE);
});

it('should parse colorify annotations', function (): void {
    assertMatchesDocumentSnapshot(<<<'CODE'
Hello #ff55ff [lighty colorify]
CODE);
});

it('should parse the lineNumber annotation with a fixed modifier', function (string $type): void {
    assertMatchesDocumentSnapshot(<<<"CODE"
// This is a long bit of text, hard to reindex the middle.
return <<<EOT
spring sunshine
the smell of waters
from the stars

deep winter
the smell of a crow [lighty {$type}(99)]
from the stars

beach to school
the smell of water
in the sky
EOT;[lighty highlight:-9,1]
CODE);
})->with(['lineNumber', 'reindex']);

it('should parse the lineNumber annotation with a null modifier', function (string $type): void {
    assertMatchesDocumentSnapshot(<<<"CODE"
// This is a long bit of text, hard to reindex the middle. [lighty {$type}(0):5,5]
return <<<EOT
spring sunshine
the smell of waters
from the stars

deep winter
the smell of a crow
from the stars

beach to school
the smell of water
in the sky
EOT;[lighty highlight:-8,3]
CODE);
})->with(['lineNumber', 'reindex']);

it('should parse the lineNumber annotation with an incrementing modifier', function (string $type): void {
    assertMatchesDocumentSnapshot(<<<"CODE"
// This is a long bit of text, hard to reindex the middle. [lighty {$type}(+5):5,5]
return <<<EOT
spring sunshine
the smell of waters
from the stars

deep winter
the smell of a crow
from the stars

beach to school
the smell of water
in the sky
EOT;[lighty highlight:-8,3]
CODE);
})->with(['lineNumber', 'reindex']);

it('should parse the lineNumber annotation with an decrementing modifier', function (string $type): void {
    assertMatchesDocumentSnapshot(<<<"CODE"
// This is a long bit of text, hard to reindex the middle. [lighty {$type}(-5):5,5]
return <<<EOT
spring sunshine
the smell of waters
from the stars

deep winter
the smell of a crow
from the stars

beach to school
the smell of water
in the sky
EOT;[lighty highlight:-8,3]
CODE);
})->with(['lineNumber', 'reindex']);

it('should parse the lineNumber annotation with an incrementing modifier and range (start and end)', function (string $type): void {
    assertMatchesDocumentSnapshot(<<<"CODE"
return [
    'extensions' => [
        // Add attributes straight from markdown.
        AttributesExtension::class,[lighty add]
        // Add Lighty syntax highlighting.
        SomeOtherHighlighter::class,[lighty delete]
        LightyExtension::class,[lighty {$type}(+50):start]
    ]
][lighty {$type}(+50):end]
CODE);
})->with(['lineNumber', 'reindex']);

it('should parse the lineNumber annotation with an decrementing modifier and range (start and end)', function (string $type): void {
    assertMatchesDocumentSnapshot(<<<"CODE"
return [
    'extensions' => [
        // Add attributes straight from markdown.
        AttributesExtension::class,[lighty add]
        // Add Lighty syntax highlighting.
        SomeOtherHighlighter::class,[lighty delete]
        LightyExtension::class,[lighty {$type}(-5):start]
    ]
][lighty {$type}(-5):end]
CODE);
})->with(['lineNumber', 'reindex']);

it('should parse the [showLineNumbers] option', function (): void {
    $document = (new DocumentParser())->parse(<<<'CODE'
// lighty {"showLineNumbers": false}
hello
CODE);

    expect($document->getSanitizedCode())->toBe('hello');
    expect($document->getShowLineNumbers())->toBeFalse();
    expect($document->getShowDiffIndicators())->toBeTrue();
    expect($document->getShowDiffIndicatorsInPlaceOfLineNumbers())->toBeTrue();
});

it('should parse the [showDiffIndicators] option', function (): void {
    $document = (new DocumentParser())->parse(<<<'CODE'
// lighty {"showDiffIndicators": false}
hello
CODE);

    expect($document->getSanitizedCode())->toBe('hello');
    expect($document->getShowLineNumbers())->toBeTrue();
    expect($document->getShowDiffIndicators())->toBeFalse();
    expect($document->getShowDiffIndicatorsInPlaceOfLineNumbers())->toBeTrue();
});

it('should parse the [showDiffIndicatorsInPlaceOfLineNumbers] option', function (): void {
    $document = (new DocumentParser())->parse(<<<'CODE'
// lighty {"showDiffIndicatorsInPlaceOfLineNumbers": false}
hello
CODE);

    expect($document->getSanitizedCode())->toBe('hello');
    expect($document->getShowLineNumbers())->toBeTrue();
    expect($document->getShowDiffIndicators())->toBeTrue();
    expect($document->getShowDiffIndicatorsInPlaceOfLineNumbers())->toBeFalse();
});
