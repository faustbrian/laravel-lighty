<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Tests\Unit\Extension;

use BaseCodeOy\Lighty\Extension\BuildMarketplaceLink;
use BaseCodeOy\Lighty\Extension\Extension;

it('should parse the package.json for themes', function (): void {
    $link = BuildMarketplaceLink::execute(Extension::fromString('GitHub.github-vscode-theme'));

    expect($link)->toBe('https://GitHub.gallery.vsassets.io/_apis/public/gallery/publisher/GitHub/extension/github-vscode-theme/latest/assetbyname/Microsoft.VisualStudio.Services.VSIXPackage');
});
