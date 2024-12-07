---
title: HTML IDs
description: The ids annotation will apply the specified HTML ids to the line(s) it is applied to.
breadcrumbs: [Documentation, Annotations, HTML IDs]
---

```php
// lighty {"skipLineParsing": true}
return [
    'extensions' => [
        // Add attributes straight from markdown.
        AttributesExtension::class,
        // Add Lighty syntax highlighting.
        LightyExtension::class,[lighty highlight #pulse]
    ]
]
```

```php
return [
    'extensions' => [
        // Add attributes straight from markdown.
        AttributesExtension::class,
        // Add Lighty syntax highlighting.
        LightyExtension::class,[lighty highlight #pulse]
    ]
]
```
