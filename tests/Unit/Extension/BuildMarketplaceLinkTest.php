<?php

declare(strict_types=1);

namespace Tests\Unit\Extension;

use BombenProdukt\Lighty\Extension\BuildMarketplaceLink;
use BombenProdukt\Lighty\Extension\Extension;

it('should parse the package.json for themes', function (): void {
    $link = BuildMarketplaceLink::execute(Extension::fromString('GitHub.github-vscode-theme'));

    expect($link)->toBe('https://GitHub.gallery.vsassets.io/_apis/public/gallery/publisher/GitHub/extension/github-vscode-theme/latest/assetbyname/Microsoft.VisualStudio.Services.VSIXPackage');
});
