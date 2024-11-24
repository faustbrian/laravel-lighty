<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Lighty\CommonMark;

use BaseCodeOy\Lighty\Config\Theme;
use Illuminate\Support\Facades\Config;
use League\CommonMark\Extension\CommonMark\Node\Block\FencedCode;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\NodeRendererInterface;
use League\CommonMark\Util\Xml;
use League\CommonMark\Xml\XmlNodeRendererInterface;

final class FencedCodeRenderer implements NodeRendererInterface, XmlNodeRendererInterface
{
    public function __construct(
        private readonly RendererInterface $renderer,
    ) {}

    /**
     * @param FencedCode $node
     *
     * {@inheritDoc}
     *
     * @psalm-suppress MoreSpecificImplementedParamType
     */
    public function render(Node $node, ChildNodeRendererInterface $childRenderer): \Stringable
    {
        FencedCode::assertInstanceOf($node);

        $infoWords = $node->getInfoWords();

        if (empty($infoWords)) {
            throw new \RuntimeException('Fenced code block must have an info string');
        }

        $codeBlocks = [];

        /** @var Theme $theme */
        foreach (Config::get('lighty.theme') as $theme) {
            $codeBlocks[] = $this->renderer->render(
                body: \trim(Xml::escape($node->getLiteral())),
                language: Xml::escape($infoWords[0]),
                theme: $theme->getName(),
                options: [
                    'data' => [
                        'theme' => $theme->getType(),
                    ],
                ],
            );
        }

        return new CodeBlock(\implode('', $codeBlocks));
    }

    public function getXmlTagName(Node $node): string
    {
        return 'code_block';
    }

    /**
     * @param  FencedCode            $node
     * @return array<string, scalar>
     *
     * @psalm-suppress MoreSpecificImplementedParamType
     */
    public function getXmlAttributes(Node $node): array
    {
        FencedCode::assertInstanceOf($node);

        if (($info = $node->getInfo()) === null || $info === '') {
            return [];
        }

        return ['info' => $info];
    }
}
