---
title: Reindex
description: The reindex annotation will reassign the line number of the line(s) it is applied to.
breadcrumbs: [Documentation, Annotations, Reindex]
---

## Fixed

The **reindex(n)** annotation will reassign the line number of the line(s) it is
applied to.

```php
// lighty {"skipLineParsing": true}
// This is a long bit of text, hard to reindex the middle.
return <<<EOT
spring sunshine
the smell of waters
from the stars

deep winter
the smell of a crow [lighty reindex(99)]
from the stars

beach to school
the smell of water
in the sky
EOT;[lighty highlight:-9,1]
```

```php
// This is a long bit of text, hard to reindex the middle.
return <<<EOT
spring sunshine
the smell of waters
from the stars

deep winter
the smell of a crow [lighty reindex(99)]
from the stars

beach to school
the smell of water
in the sky
EOT;[lighty highlight:-9,1]
```

## Increment

The **reindex(+n)** annotation will increment the line number of the line(s) it
is applied to.

```php
// lighty {"skipLineParsing": true}
// This is a long bit of text, hard to reindex the middle. [lighty reindex(+5):5,5]
return <<<EOT
spring sunshine
the smell of waters
from the stars

deep winter
the smell of a crow
from the stars

beach to school
the smell of water
in the sky
EOT;[lighty highlight:-8,3]
```

```php
// This is a long bit of text, hard to reindex the middle. [lighty reindex(+5):5,5]
return <<<EOT
spring sunshine
the smell of waters
from the stars

deep winter
the smell of a crow
from the stars

beach to school
the smell of water
in the sky
EOT;[lighty highlight:-8,3]
```

## Decrement

The **reindex(-n)** annotation will decrement the line number of the line(s) it
is applied to.

```php
// lighty {"skipLineParsing": true}
// This is a long bit of text, hard to reindex the middle. [lighty reindex(-5):5,5]
return <<<EOT
spring sunshine
the smell of waters
from the stars

deep winter
the smell of a crow
from the stars

beach to school
the smell of water
in the sky
EOT;[lighty highlight:-8,3]
```

```php
// This is a long bit of text, hard to reindex the middle. [lighty reindex(-5):5,5]
return <<<EOT
spring sunshine
the smell of waters
from the stars

deep winter
the smell of a crow
from the stars

beach to school
the smell of water
in the sky
EOT;[lighty highlight:-8,3]
```

## Hide

The **reindex(0)** annotation will hide the line(s) it is applied to.

```php
// lighty {"skipLineParsing": true}
// This is a long bit of text, hard to reindex the middle. [lighty reindex(null):5,5]
return <<<EOT
spring sunshine
the smell of waters
from the stars

deep winter
the smell of a crow
from the stars

beach to school
the smell of water
in the sky
EOT;[lighty highlight:-8,3]
```

```php
// This is a long bit of text, hard to reindex the middle. [lighty reindex(null):5,5]
return <<<EOT
spring sunshine
the smell of waters
from the stars

deep winter
the smell of a crow
from the stars

beach to school
the smell of water
in the sky
EOT;[lighty highlight:-8,3]
```
