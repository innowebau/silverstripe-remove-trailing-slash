# Silverstripe Remove Trailing Slash

[![Version](http://img.shields.io/packagist/v/innoweb/silverstripe-remove-trailing-slash.svg?style=flat-square)](https://packagist.org/packages/innoweb/silverstripe-remove-trailing-slash)
[![License](http://img.shields.io/packagist/l/innoweb/silverstripe-remove-trailing-slash.svg?style=flat-square)](license.md)

## Overview

Removes the trailing slash from page links.

SiteTree is the only class in Silverstripe that adds trailing slashes to links. This module cleans that up.

## Requirements

* Silverstripe CMS 4.x

The changes from this module have been folded into core for Silverstripe 5, see [2780](https://github.com/silverstripe/silverstripe-cms/issues/2780). 

## Installation

Install the module using composer:
```
composer require innoweb/silverstripe-remove-trailing-slash dev-master
```
Then run dev/build.

## Configuration

Unfortunately, `SiteTree::RelativeLink()` contains an issue, where the base link and action are joined with a forced `/`. When no action is available, this leaves a trailing slash.

Because the extension point `updateRelativeLink` is called before that join, you need to overwrite `Page::RelativeLink()` with the following code:

```
/**
 * Remove trailing slash from page links. SiteTree forces a trailing slash if no action is set, which doesn't
 * make sense, really. Every other functionality in SS doesn't add the trailing slash, e.g. in HTTP and
 * HTTPRequest classes.
 *
 * @see \SilverStripe\CMS\Model\SiteTree::RelativeLink()
 */
public function RelativeLink($action = null)
{
	$link = parent::RelativeLink($action);
	$link = rtrim($link, '/');
	return $link;
}
```

See details to this issue in [pull request 2677](https://github.com/silverstripe/silverstripe-cms/pull/2677).

## License

BSD 3-Clause License, see [License](license.md)
