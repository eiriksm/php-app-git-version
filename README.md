# eiriksm/gitinfo

[![Packagist](https://img.shields.io/packagist/v/eiriksm/gitinfo.svg?maxAge=3600)](https://packagist.org/packages/eiriksm/gitinfo)
[![Packagist](https://img.shields.io/packagist/dt/eiriksm/gitinfo.svg?maxAge=3600)](https://packagist.org/packages/eiriksm/gitinfo)
[![Coverage Status](https://coveralls.io/repos/github/eiriksm/php-app-git-version/badge.svg?branch=master)](https://coveralls.io/github/eiriksm/php-app-git-version?branch=master)
[![Build Status](https://travis-ci.org/eiriksm/php-app-git-version.svg?branch=master)](https://travis-ci.org/eiriksm/php-app-git-version)
[![Violinist enabled](https://img.shields.io/badge/violinist-enabled-brightgreen.svg)](https://violinist.io)

A package to get git info from your application. You can use this to display application information about your app, which in turn is useful for generating bug reports or user feedback.

You can also use it as an indication to your users of your last update of your application.

This is what powers the version string on [Violinist.io](https://violinist.io/) where you can get free, automated composer updates for life!

## Installation

Install with composer:

```bash
composer require eiriksm/gitinfo
```

## Usage

You use this based on your preferred method of output.

```php
use eiriksm\GitInfo\GitInfo;
$info = new GitInfo();
$hash = $info->getShortHash(); // Example output: f09037f
$date = $info->getDate(); // Example output (last commit date): 2020-05-31 09:05:40
$version = $info->getVersion(); // Example output: 1.1.1-2-gf09037f, or if on a clean tag: 1.1.1
$app_version = $info->getApplicationVersionString(); // v.1.1.1-2-gf09037f.f09037f (2020-05-31 09:05:40)
```

## Licence

MIT
