<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Tests\Unit\Extension;

use BaseCodeOy\Lighty\Extension\DownloadExtension;
use BaseCodeOy\Lighty\Extension\Extension;
use BaseCodeOy\Lighty\Extension\ExtractExtension;

it('returns true when extraction is successful', function (): void {
    $extension = Extension::fromString('GitHub.github-vscode-theme');

    DownloadExtension::execute($extension);

    $result = ExtractExtension::execute($extension);

    expect($result)->toBeTrue();
});

it('returns false when extraction is unsuccessful', function (): void {
    $result = ExtractExtension::execute(Extension::fromString('publisher.extension'));

    expect($result)->toBeFalse();
});
