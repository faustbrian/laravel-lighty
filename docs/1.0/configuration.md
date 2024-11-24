---
title: Configuration
description: Lighty offers extensive configuration options.
breadcrumbs: [Documentation, Configuration]
---

You may publish the configuration file using the following command:

```bash
php artisan vendor:publish --tag="laravel-lighty-config"
```

## Storage Path

The **storage_path** option defines the path where Lighty will store
extensions, grammars and themes. This path should be relative to the root of
your project.

```php
'storage_path' => storage_path('lighty'),
```

## Grammars

The **grammars** option defines the grammars that Lighty should synchronize.
Each grammar should be a project from the Visual Studio Marketplace.

```php
'grammars' => [],
```

## Themes

The **themes** option defines the themes that Lighty should synchronize. Each
theme should be a project from the Visual Studio Marketplace.

```php
'themes' => [],
```

## Default Language

The **language** option defines the default language that Lighty should use.
This language will be used if no language is specified in the annotation.

```php
'language' => 'php',
```

## Default Theme

The **theme** option defines the default theme that Lighty should use. This
theme will be used if no theme is specified in the annotation.

```php
'theme' => 'nord',
```

## Regular Expression

The **regexp** option defines the regular expression that Lighty should use
to parse your code. The default expression is `[lighty\s(.+?)]`. You may need
to change this value if you are using a different syntax.

```php
'regexp' => '/\[lighty\s(.+?)\]/',
```

## Annotations

The **annotations** option defines the annotations that Lighty should parse.
Each annotation should be a class that implements the `AnnotationInterface`. You
may add your own annotations to this array if you wish.

```php
'annotations' => [
    BaseCodeOy\Lighty\Annotation\AddAnnotation::class,
    BaseCodeOy\Lighty\Annotation\AutolinkAnnotation::class,
    BaseCodeOy\Lighty\Annotation\CollapseAnnotation::class,
    BaseCodeOy\Lighty\Annotation\DeleteAnnotation::class,
    BaseCodeOy\Lighty\Annotation\FocusAnnotation::class,
    BaseCodeOy\Lighty\Annotation\HighlightAnnotation::class,
    BaseCodeOy\Lighty\Annotation\HtmlClassAnnotation::class,
    BaseCodeOy\Lighty\Annotation\HtmlIdAnnotation::class,
    BaseCodeOy\Lighty\Annotation\LineNumberAnnotation::class,
],
```

## Line Numbers

The **showLineNumbers** option defines whether Lighty should show line
numbers. You may disable this if you wish to do so.

```php
'showLineNumbers' => true,
```

## Diff Indicators

The **showDiffIndicators** option defines whether Lighty should show diff
indicators. This will show a `+` or `-` next to each line to indicate whether it
has been added or removed. You may disable this if you wish to do so.

```php
'showDiffIndicators' => true,
```

## Diff Indicators In Place Of Line Numbers

The **showDiffIndicatorsInPlaceOfLineNumbers** option defines whether Lighty
should show diff indicators in place of line numbers. This will show a `+` or
`-` next to each line to indicate whether it has been added or removed. You may
disable this if you wish to do so.

```php
'showDiffIndicatorsInPlaceOfLineNumbers' => true,
```
