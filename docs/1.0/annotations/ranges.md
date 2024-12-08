---
title: Ranges
description: Ranges are utilized for applying annotations across a series of lines.
breadcrumbs: [Documentation, Annotations, Ranges]
---

Ranges are utilized for applying annotations across a series of lines. They
possess a variety of applications. The examples provided below are all valid,
and they will demonstrate the **highlight** annotation for illustrative
purposes.

## Current

This will apply the effects of the **highlight** annotation to the current line.

```text
highlight
```

## Start

This will apply the effects of the **highlight** annotation starting from the
current line. This has to be used in conjunction with the **end** annotation.

```text
highlight:start
```

## End

This will apply the effects of the **highlight** annotation up to the current
line. This has to be used in conjunction with the **start** annotation.

```text
highlight:end
```

## Following

This will apply the effects of the **highlight** annotation to the following
lines.

```text
highlight:10
```

## Following (Range)

This will apply the effects of the **highlight** annotation starting from the
next line, and highlight 10 lines total.

```text
highlight:1,10
```

## Preceding

This will apply the effects of the **highlight** annotation to the preceding
lines.

```text
highlight:-10
```

## Preceding (Range)

This will apply the effects of the **highlight** annotation starting from the
previous line, and highlight 10 lines total.

```text
highlight:-1,10
```
