# SubPageList installation

These are the installation instructions for the [SubPageList extension](README.md).

SubPageList has the following dependencies:

* [ParamProcessor](https://www.mediawiki.org/wiki/Extension:ParamProcessor) 1.0 or later
* [ParserHooks](https://github.com/wikimedia/mediawiki-extensions-ParserHooks/blob/master/README.md) 1.1 or later
* [MediaWiki](https://www.mediawiki.org/) 1.16 or later

And nothing else.

It also requires PHP 5.3 or above to run.

Installation with Composer
--------------------------

The standard and recommended way to install SubPageList is with [Composer](http://getcomposer.org).
If you do not have Composer yet, you first need to install it, or
[get the composer.phar file](http://getcomposer.org/composer.phar).

Depending on your situation, pick one of the following approaches:

1. If you already have a copy of the SubPageList code, change into its root
directory and type "composer install". This will install all dependencies of SubPageList.

2. If you want to get SubPageList and all of its dependencies, use
"composer create-package mediawiki/sub-page-list".

For more information on using Composer, see [using composer](http://getcomposer.org/doc/01-basic-usage.md).

The entry point of SubPageList is SubPageList.php. Including this file
takes care of autoloading and defining the version constant of this component.

Installation without composer
-----------------------------

If you install without composer, simply include the entry point file. You are then
responsible for loading all dependencies of this component before including the
entry point, and can do this in whatever way you see fit.

For instance, you can include this in your LocalSettings.php file:

  require_once( "$IP/extensions/SubPageList/SubPageList.php" );

Configuration
-------------

After you are done with installing, it is time to [update your configuration](CONFIGURATION.md).