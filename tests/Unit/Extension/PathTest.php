<?php

declare(strict_types=1);

namespace Tests\Unit\Extension;

use BaseCodeOy\Lighty\Extension\Extension;
use BaseCodeOy\Lighty\Extension\Grammar;
use BaseCodeOy\Lighty\Extension\Path;
use BaseCodeOy\Lighty\Extension\Theme;
use Illuminate\Support\Facades\Config;

beforeEach(function (): void {
    Config::shouldReceive('get')->with('lighty.storage_path')->andReturn('/storage_path');
});

it('returns correct root path', function (): void {
    expect(Path::root())->toBe('/storage_path');
    expect(Path::root('test'))->toBe('/storage_path/test');
});

it('returns correct extension path', function (): void {
    $extension = new Extension('publisher', 'extension');
    expect(Path::extension($extension))->toBe('/storage_path/extensions/publisher/extension');
});

it('returns correct grammars path', function (): void {
    expect(Path::grammars())->toBe('/storage_path/grammars');
});

it('returns correct grammar path', function (): void {
    $extension = new Extension('publisher', 'extension');
    $grammar = new Grammar('language', 'scope', 'path');

    expect(Path::grammar($extension, $grammar))->toBe('/storage_path/grammars/publisher/extension/path');
});

it('returns correct themes path', function (): void {
    expect(Path::themes())->toBe('/storage_path/themes');
});

it('returns correct theme path', function (): void {
    $extension = new Extension('publisher', 'extension');
    $theme = new Theme('name', 'type', 'path');

    expect(Path::theme($extension, $theme))->toBe('/storage_path/themes/publisher/extension/path');
});

it('returns correct normalized path', function (): void {
    $extension = new Extension('publisher', 'extension');

    expect(Path::normalize($extension, './test'))->toBe('/storage_path/extensions/publisher/extension/extension/test');
});
