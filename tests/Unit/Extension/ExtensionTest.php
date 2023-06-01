<?php

declare(strict_types=1);

namespace Tests\Unit\Extension;

use BombenProdukt\Lighty\Extension\Extension;

it('can be constructed from string', function (): void {
    $extension = Extension::fromString('publisher.extension');

    expect($extension->getPublisher())->toBe('publisher');
    expect($extension->getExtension())->toBe('extension');
});

it('returns correct publisher and extension', function (): void {
    $extension = new Extension('publisher', 'extension');

    expect($extension->getPublisher())->toBe('publisher');
    expect($extension->getExtension())->toBe('extension');
});

it('returns correct paths', function (): void {
    $extension = new Extension('publisher', 'extension');

    expect($extension->path())->toEndWith('lighty/extensions/publisher/extension');
    expect($extension->filePath())->toEndWith('lighty/extensions/publisher/extension.zip');
});
