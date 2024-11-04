<?php

declare(strict_types=1);

namespace BaseCodeOy\Lighty\Extension;

final class BuildMarketplaceLink
{
    public static function execute(Extension $extension): string
    {
        return \sprintf(
            'https://%s.gallery.vsassets.io/_apis/public/gallery/publisher/%s/extension/%s/latest/assetbyname/Microsoft.VisualStudio.Services.VSIXPackage',
            $extension->getPublisher(),
            $extension->getPublisher(),
            $extension->getExtension(),
        );
    }
}
