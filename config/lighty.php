<?php

declare(strict_types=1);

use BaseCodeOy\Lighty\Annotation\AddAnnotation;
use BaseCodeOy\Lighty\Annotation\CollapseAnnotation;
use BaseCodeOy\Lighty\Annotation\ColorifyAnnotation;
use BaseCodeOy\Lighty\Annotation\DeleteAnnotation;
use BaseCodeOy\Lighty\Annotation\FocusAnnotation;
use BaseCodeOy\Lighty\Annotation\HighlightAnnotation;
use BaseCodeOy\Lighty\Annotation\HtmlClassAnnotation;
use BaseCodeOy\Lighty\Annotation\HtmlIdAnnotation;
use BaseCodeOy\Lighty\Annotation\LineNumberAnnotation;
use BaseCodeOy\Lighty\Annotation\LinkifyAnnotation;
use BaseCodeOy\Lighty\Config\Theme;

return [
    /*
    |--------------------------------------------------------------------------
    | Storage Path
    |--------------------------------------------------------------------------
    |
    | Here you may specify the root path that Lighty should use to store
    | extensions, grammars and themes. This path should be relative to the
    | root of your project. You may change this value if you wish to do so.
    |
    */

    'storage_path' => storage_path('lighty'),

    /*
    |--------------------------------------------------------------------------
    | Grammars (Visual Studio Marketplace)
    |--------------------------------------------------------------------------
    |
    | Here you may specify the grammars that Lighty should synchronize. Each
    | grammar should be a project from the Visual Studio Marketplace.
    |
    */

    'grammars' => [
        'ziglang.vscode-zig',
    ],

    /*
    |--------------------------------------------------------------------------
    | Themes (Visual Studio Marketplace)
    |--------------------------------------------------------------------------
    |
    | Here you may specify the themes that Lighty should synchronize. Each
    | theme should be a project from the Visual Studio Marketplace.
    |
    */

    'themes' => [
        'GitHub.github-vscode-theme',
    ],

    /*
    |--------------------------------------------------------------------------
    | Default Language
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default language that Lighty should use. This
    | language will be used if no language is specified in the annotation. You
    | may change this value if you wish to do so.
    |
    */

    'language' => 'php',

    /*
    |--------------------------------------------------------------------------
    | Default Theme
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default theme that Lighty should use. This
    | theme will be used if no theme is specified in the annotation. You may
    | change this value if you wish to do so.
    |
    */

    'theme' => [
        Theme::light('github-light'),
        Theme::dark('github-dark'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Regular Expression
    |--------------------------------------------------------------------------
    |
    | Here you may specify the regular expression that Lighty should use to
    | parse your code. The default expression is {lighty\s(.+?)}. You may
    | need to change this value if you are using a different syntax.
    |
    */

    'regexp' => '/\[lighty\s(.+?)\]/',
    // 'regexp' => '\{lighty\s(.+?)\}',

    /*
    |--------------------------------------------------------------------------
    | Annotations
    |--------------------------------------------------------------------------
    |
    | Here you may specify the annotations that Lighty should parse. Each
    | annotation should be a class that implements the AnnotationInterface.
    | You may add your own annotations to this array if you wish.
    |
    */

    'annotations' => [
        AddAnnotation::class,
        CollapseAnnotation::class,
        ColorifyAnnotation::class,
        DeleteAnnotation::class,
        FocusAnnotation::class,
        HighlightAnnotation::class,
        HtmlClassAnnotation::class,
        HtmlIdAnnotation::class,
        LineNumberAnnotation::class,
        LinkifyAnnotation::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Line Numbers
    |--------------------------------------------------------------------------
    |
    | Here you may specify whether Lighty should show line numbers. You may
    | disable this if you wish to do so.
    |
    */

    'showLineNumbers' => true,

    /*
    |--------------------------------------------------------------------------
    | Diff Indicators
    |--------------------------------------------------------------------------
    |
    | Here you may specify whether Lighty should show diff indicators. This
    | will show a + or - next to each line to indicate whether it has been
    | added or removed. You may disable this if you wish to do so.
    |
    */

    'showDiffIndicators' => true,

    /*
    |--------------------------------------------------------------------------
    | Diff Indicators In Place Of Line Numbers
    |--------------------------------------------------------------------------
    |
    | Here you may specify whether Lighty should show diff indicators in
    | place of line numbers. This will show a + or - next to each line to
    | indicate whether it has been added or removed. You may disable this if
    | you wish to do so.
    |
    */

    'showDiffIndicatorsInPlaceOfLineNumbers' => true,

    /*
    |--------------------------------------------------------------------------
    | API URL & Token
    |--------------------------------------------------------------------------
    |
    | Here you may specify the URL and token that Lighty should use to
    | communicate with the Lighty API. You may change these values if you
    | wish to do so.
    |
    */

    'api' => [
        'url' => env('LIGHTY_URL', 'https://lighty.dev/api'),
        'token' => env('LIGHTY_TOKEN'),
    ],
];
