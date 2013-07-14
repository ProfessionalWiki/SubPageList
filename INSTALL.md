Installation of the SubPageList MediaWiki extension
===================================================

SubPageList has the following dependencies:

* [ParamProcessor](https://www.mediawiki.org/wiki/Extension:ParamProcessor) 1.0 or later
* [ParserHooks](https://github.com/wikimedia/mediawiki-extensions-ParserHooks/blob/master/README.md) 1.0 or later
* [MediaWiki](https://www.mediawiki.org/) 1.16 or later

And nothing else.

It also requires PHP 5.3 or above to run.

Installation with Composer
--------------------------

The standard and recommended way to install SubPageList is with [Composer](http://getcomposer.org).
If you do not have Composer yet, you first need to install it, or get the composer.phar file.

Depending on your situation, pick one of the following approaches:

1. If you already have a copy of the SubPageList code, change into its root
directory and type "composer install". This will install all dependencies of SubPageList.

2. If you want to get SubPageList and all of its dependencies, use
"composer create-package jeroen-de-dauw/mediawiki-github".

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
=============

Configuration of SubPageList is done by adding simple PHP statements to your [[Manual:LocalSettings.php|LocalSettings.php]]
file. These statements need to be placed AFTER the inclusion of SubPageList. The options are listed below and their default
is set in the SubPageList settings file.
You should NOT modify the settings file, but can have a look at it to get an idea of how to use the
settings, in case the below descriptions do not suffice.

As of version 0.3, you can choose to automatically refresh subpage lists
that are on the base page of subpages you add, move or delete, or on one
of the subpages of the base page. This behaviour is off by default as it
can produce extra load on your server, but can be turned on with this code:

$egSPLAutorefresh = true;

General subpage settings
------------------------

MediaWiki itself has some support for subpages, which causes back links
to be displayed on subpages to their parent pages. To enable this you
need to set [[Manual:$wgNamespacesWithSubpages|wgNamespacesWithSubpages]],
which is a per namespace setting, like shown below:

$wgNamespacesWithSubpages[NS_MAIN] = 1;