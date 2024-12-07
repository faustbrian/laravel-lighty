<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Tests\Unit;

it('should render a document as HTML (Start and End)', function (string $type): void {
    assertMatchesShikiSnapshot(<<<"CODE"
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
