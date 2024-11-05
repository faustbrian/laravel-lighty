---
title: HTML Classes
description: The classes annotation will apply the specified HTML classes to the line(s) it is applied to.
breadcrumbs: [Documentation, Annotations, HTML Classes]
---

```php
// lighty {"skipLineParsing": true}
return [
    'extensions' => [
        // Add attributes straight from markdown.
        AttributesExtension::class,
        // Add Lighty syntax highlighting.[lighty highlight .animate-pulse]
        LightyExtension::class,[lighty highlight .font-bold .italic .animate-pulse]
    ]
]
```

```php
return [
    'extensions' => [
        // Add attributes straight from markdown.
        AttributesExtension::class,
        // Add Lighty syntax highlighting.[lighty highlight .animate-pulse]
        LightyExtension::class,[lighty highlight .font-bold .italic .animate-pulse]
    ]
]
```
