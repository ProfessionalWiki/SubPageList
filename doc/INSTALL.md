# SubPageList installation

These are the installation instructions for the [SubPageList extension](../README.md).

SubPageList has the following dependencies:

* [MediaWiki](https://www.mediawiki.org/) 1.16 or later
* [ParamProcessor](https://www.mediawiki.org/wiki/Extension:ParamProcessor) 1.0 or later
* [ParserHooks](https://github.com/wikimedia/mediawiki-extensions-ParserHooks/blob/master/README.md) 1.1 or later

And nothing else.

It also requires PHP 5.3 or above to run.

## Manual installation

First you need to get the code. This can be done either by downloading a tarball,
or by cloning the git repository.

If you clone the git repo, you must take care to also get the code of all dependencies.
The direct dependencies are listed above, though they themselves can have further dependencies.
Tarballs already include all dependencies.

Once you got the code, place the "SubPageList" directory, and the directories of
the dependencies in your MediaWiki "extensions" directory.

The only remaining step is to include SubPageList in your LocalSettings.php file:

    require_once( "$IP/extensions/SubPageList/SubPageList.php" );

You do not need to include the dependencies yourself (though you can), as they
will be automatically loaded.

## Installation with Composer

You can install SubPageList is with [Composer](http://getcomposer.org).
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

## Configuration

After you are done with installing, it is time to [update your configuration](CONFIGURATION.md).