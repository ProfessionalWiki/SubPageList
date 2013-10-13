# SubPageList installation

These are the installation and configuration instructions for the [SubPageList extension](../README.md).

SubPageList has the following dependencies:

* [MediaWiki](https://www.mediawiki.org/) 1.16 or later
* [ParamProcessor](https://www.mediawiki.org/wiki/Extension:ParamProcessor) 1.0 or later
* [ParserHooks](https://github.com/wikimedia/mediawiki-extensions-ParserHooks/blob/master/README.md) 1.2 or later

It also requires PHP 5.3 or above to run.

## Download

The simplest way to get SubPageList and the libraries it needs is by getting
[one of the tarballs](https://code.google.com/p/subpagelist/downloads/list).

You can also use Git to get SubPageList:

    git clone https://gerrit.wikimedia.org/r/p/mediawiki/extensions/SubPageList.git

Note that you then also need to get the required libraries yourself. The same
is true when getting one of the [tarballs that only contain SubPageList]
(https://github.com/wikimedia/mediawiki-extensions-SubPageList/releases).

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

You do not need to include the dependencies yourself, as they will be automatically loaded.

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

After you are done with installing, it is time to update your configuration.

Configuration of SubPageList is done by adding simple PHP statements to your [[Manual:LocalSettings.php|LocalSettings.php]]
file. These statements need to be placed AFTER the inclusion of SubPageList. The options are listed below and their default
is set in the SubPageList settings file.
You should NOT modify the settings file, but can have a look at it to get an idea of how to use the
settings, in case the below descriptions do not suffice.

### Automatic refresh

You can choose to automatically refresh subpage lists
that are on the base page of subpages you add, move or delete, or on one
of the subpages of the base page. This behaviour is off by default as it
can produce extra load on your server, but can be turned on with this code:

$egSPLAutorefresh = true;

### General subpage settings

MediaWiki itself has some support for subpages, which causes back links
to be displayed on subpages to their parent pages. To enable this you
need to set [[Manual:$wgNamespacesWithSubpages|wgNamespacesWithSubpages]],
which is a per namespace setting, like shown below:

$wgNamespacesWithSubpages[NS_MAIN] = 1;