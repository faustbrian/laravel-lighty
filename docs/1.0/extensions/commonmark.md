---
title: CommonMark
description: The CommonMark extension allows you to use annotations in your markdown files.
breadcrumbs: [Documentation, Extensions, CommonMark]
---

Lighty offers a [CommonMark](https://commonmark.thephpleague.com/) extension
that allows you to use annotations in your markdown files. To use this
extension, you must add it to your CommonMark Environment.

## Local Rendering

The **LocalRenderer** will render the code on your server. This is the
recommended renderer if you are working with code that you don't want to send to
a third-party API. It requires you to have [Shiki](https://shiki.matsu.io/) and
[linkify-urls](https://github.com/sindresorhus/linkify-urls) on your server.

```php
use BaseCodeOy\Lighty\CommonMark\FencedCodeRenderer;
use BaseCodeOy\Lighty\CommonMark\LocalRenderer;
use League\CommonMark\Extension\CommonMark\Node\Block\FencedCode;
use League\CommonMark\Environment\Environment;
use League\CommonMark\MarkdownConverter;

$environment = new Environment();
$environment->addRenderer(FencedCode::class, new FencedCodeRenderer(new LocalRenderer()));

$converter = new MarkdownConverter($environment);
echo $converter->convert('**Hello World!**');
```

## Remote Rendering

The **RemoteRenderer** will render the code using the
[Lighty API](https://uselighty.com/api). This renderer will send your code to
the API and return the rendered HTML. This will require you to have an API
token. You can get an API token by signing up on
[uselighty.com](https://uselighty.com/register).

```php
use BaseCodeOy\Lighty\CommonMark\FencedCodeRenderer;
use BaseCodeOy\Lighty\CommonMark\RemoteRenderer;
use League\CommonMark\Extension\CommonMark\Node\Block\FencedCode;
use League\CommonMark\Environment\Environment;
use League\CommonMark\MarkdownConverter;

$environment = new Environment();
$environment->addRenderer(FencedCode::class, new FencedCodeRenderer(new RemoteRenderer('YOUR_API_TOKEN')));

$converter = new MarkdownConverter($environment);
echo $converter->convert('**Hello World!**');
```

## Caching

The **CacheRenderer** will cache the rendered HTML. This is useful when you are
rendering a lot of code blocks, like for example when you are rendering a blog
post. This renderer will prevent the same code block from being rendered
multiple times.

```php
use BaseCodeOy\Lighty\CommonMark\CacheRenderer;

$environment->addRenderer(FencedCode::class, new FencedCodeRenderer(new CacheRenderer(new RemoteRenderer('YOUR_API_TOKEN'))));
```
