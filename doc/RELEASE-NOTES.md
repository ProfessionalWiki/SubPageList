These are the release notes for the [SubPageList extension](../README.md).


## Version 1.6.1 (2020-02-23)

* Translation updates

## Version 1.6.0 (2019-07-12)

* Changed supported MediaWiki and PHP versions. See [doc/INSTALL.md](INSTALL.md).
	* Added support for MediaWiki 1.31, 1.32 and 1.33
	* Added support for PHP 7.1, 7.2, 7.3 and 7.4
	* Dropped support for MediaWiki older than 1.31
	* Dropped support for PHP older than 7.1

## Version 1.5.0 (2017-04-14)

* Sorting of pages now includes all pages, even those not included due to the limit parameter (by Dmitriy Lutsko)
* Made internal changes that improve compatibility with future MediaWiki versions (by LukBukkit)

## Version 1.4.0 (2016-06-24)

* Added "redirects" parameter that allows for inclusion of redirects in lists (by Randy Eckman)
* Improved alphabetic sorting: it now uses natural sort (by k8n)
* Dropped support for MediaWiki older than 1.23
* Dropped support for PHP older than 5.5

## Version 1.2.0 (2015-08-05)

* The "element" parameter now supports "none" as value to not wrap the list in any HTML element.
* Added "addlevel" parameter that allows increasing the indent level of the entire list.
* Translation updates

## Version 1.1.2 (2015-01-31)

* Translation updates
* Made various minor improvements to code style.

## Version 1.1.1 (2014-06-26)

* Updated the versions of the used libraries.
* Made various minor improvements to code style.

## Version 1.1 (2013-12-07)

* Stable versions of the dependencies (ie ParserHooks) are now used.
* Removed support for non-Composer installation.
* Removed custom class autoloader.
* PHPUnit bootstrap now automatically updates dependencies on every run.

## Version 1.0 (2013-10-13)

#### Functional changes

* Added subpages aliases for the subpagelist parser hook.
* Changed pathstyle value "subpagename" to only render the last sub page part.
* All pages that have children in the result will now be discovered, even if they do not exist.
* Dropped sortby parameter.
* Dropped "bar" and "list" support as values for the format parameter.
    * Dropped separator parameter support.
* The #subpagecount parser function now always only counts just the subpages.
Its "kidsonly" parameter has been removed.

#### Compatibility changes

* Changed MediaWiki compatibility from MW 1.17-1.19 to MW >= 1.19
* Dropped support for PHP 5.2, added support for PHP 5.3, 5.4 and 5.5.
* Changed Validator compatibility from 0.4.x to 1.x.
* New dependency: ParserHooks 1.1 or later.

#### Internal improvements

* Rewrote extension from transaction script style to domain model style.
    * Data access, domain logic, application logic and presentation code have been separated.
    * Polymorphism is used instead of switches to allow for multiple behaviours.
    * Complete inversion of control, no use of globals or static outside of main
    * Abstracted away from some badly designed MediaWiki "interfaces".
* Added unit, component and system tests, covering (nearly) all behaviour.
* Made code compliant with
[PSR-0](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-0.md)
and use PSR-0 based autoloading.

#### Infrastructure

* Extension now be installed using [Composer](http://getcomposer.org).
* Unit tests can now be run using phpunit.xml.dist.
* Tests now run [on TravisCI](https://travis-ci.org/JeroenDeDauw/SubPageList).
using different PHP versions, different MediaWiki versions and both MySQL and SQLite.
* Code coverage reports are generated on coveralls.io.
* Code quality reports are generated on Scrutinizer CI.

## Version 0.5 (2011-12-27)

* Added compatibility with MediaWiki 1.18 and 1.19.
* Dropped compatibility with MediaWiki 1.15.
* Added #subpagecount parser hook.
* Fixed invalid HTML for ul and ol formats (bug 32131).

## Version 0.4 (2011-07-27)

* Added parameters for better output control: element, class, intro,
  outro, default, separator, template, links.
* Added ability to list pages in a namespace.
* Fixed compatibility with MediaWiki 1.18.

## Version 0.3 (2011-03-05)

* Added $egSPLAutorefresh option.
* Fix to display of the first list item.
* Fixed inverted behaviour of the kidsonly parameter.
* Fixed query issue when using PostGres.

## Version 0.2 (2011-01-24)

* Fixed escaping issue when using the parser function.
* Fixed bug in pathstyle and sortby parameters.
* Added parameter descriptions.

## Version 0.1 (2010-12-31)

* Copied the code of SubPageList3 and ...
    * Modified code to make use of Validator for parameter handling.
    * Rewrote most code of the SubPageList class.
    * Fixed namespace bug.
    * Fixed several minor layout issues.
    * Added alias file.
    * Added COPYING, INSTALL, README and RELEASE-NOTES.
    * Cleaned up and corrected formatting.
