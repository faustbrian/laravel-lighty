<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

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
