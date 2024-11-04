<?php

declare(strict_types=1);

namespace Tests\Unit\Extension;

use BaseCodeOy\Lighty\Extension\DownloadExtension;
use BaseCodeOy\Lighty\Extension\Extension;
use Illuminate\Support\Facades\Http;

it('returns true when download is successful', function (): void {
    $result = DownloadExtension::execute(Extension::fromString('GitHub.github-vscode-theme'));

    expect($result)->toBeTrue();
});

it('returns false when download is unsuccessful', function (): void {
    Http::fakeSequence()->push(null, 429);

    $result = DownloadExtension::execute(Extension::fromString('GitHub.github-vscode-theme'));

    expect($result)->toBeFalse();
});
