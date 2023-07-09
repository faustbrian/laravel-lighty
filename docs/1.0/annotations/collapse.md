---
title: Collapse
description: The collapse annotation will collapse the line(s) it is applied to.
breadcrumbs: [Documentation, Annotations, Collapse]
---

```php
// lighty {"skipLineParsing": true}
return [
    'heading_permalink' => [ [lighty collapse:start]
        'html_class' => 'permalink',
        'id_prefix' => 'user-content',
        'insert' => 'before',
        'title' => 'Permalink',
        'symbol' => '#',
    ],[lighty collapse:end]

    'extensions' => [
        // Add attributes straight from markdown.
        AttributesExtension::class,
        // Add Lighty syntax highlighting.
        LightyExtension::class,
    ]
]
```

```php
return [
    'heading_permalink' => [ [lighty collapse:start]
        'html_class' => 'permalink',
        'id_prefix' => 'user-content',
        'insert' => 'before',
        'title' => 'Permalink',
        'symbol' => '#',
    ],[lighty collapse:end]

    'extensions' => [
        // Add attributes straight from markdown.
        AttributesExtension::class,
        // Add Lighty syntax highlighting.
        LightyExtension::class,
    ]
]
```
