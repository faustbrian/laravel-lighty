<?php

declare(strict_types=1);

namespace BombenProdukt\Lighty\CommonMark;

use League\CommonMark\Extension\CommonMark\Node\Block\FencedCode;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\NodeRendererInterface;
use League\CommonMark\Util\Xml;
use League\CommonMark\Xml\XmlNodeRendererInterface;

final class FencedCodeRenderer implements NodeRendererInterface, XmlNodeRendererInterface
{
    public function __construct(private readonly RendererInterface $renderer) {}

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

        return new CodeBlock(
            $this->renderer->render(
                body: \trim(Xml::escape($node->getLiteral())),
                language: Xml::escape($infoWords[0]),
            ),
        );
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
