---
title: Installation
description: How to install and configure Laravel Lighty.
breadcrumbs: [Documentation, Getting Started, Installation]
---

To get the latest version, simply require the project using
[Composer](https://getcomposer.org/):

```bash
composer require faustbrian/lighty
```

You can publish the configuration file by using:

```bash
php artisan vendor:publish --tag="lighty-config"
```

You'll also need to install [Shiki](https://shiki.matsu.io/) and
[linkify-urls](https://github.com/sindresorhus/linkify-urls) on your server,
which you can do by using:

```bash
npm install shiki linkify-urls
```

Finally you'll need to include the Lighty CSS file, which you can do by
using:

```css
@import "../../vendor/faustbrian/lighty/resources/css/lighty.css";
```

That's it! You're ready to go. If you have any questions, please feel free to
[open a discussion](https://github.com/basecodeoy/lighty/discussions/new/choose)
on GitHub.
