---
title: Diffs
description: The diff annotation will apply a diff effect to the line(s) it is applied to.
breadcrumbs: [Documentation, Annotations, Diffs]
---

```php
// lighty {"skipLineParsing": true}
return [
    'extensions' => [
        // Add attributes straight from markdown.
        AttributesExtension::class,
        // Add Lighty syntax highlighting.
        SomeOtherHighlighter::class,[lighty delete]
        LightyExtension::class,[lighty add]
    ]
]
```

```php
return [
    'extensions' => [
        // Add attributes straight from markdown.
        AttributesExtension::class,
        // Add Lighty syntax highlighting.
        SomeOtherHighlighter::class,[lighty delete]
        LightyExtension::class,[lighty add]
    ]
]
```
