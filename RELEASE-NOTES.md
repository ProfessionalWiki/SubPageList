These are the release notes for the [SubPageList extension](README.md).
	


## Version 1.0 (dev)

#### Changes

* Changed pathstyle value "subpagename" to only render the last sub page part
* All pages that have children in the result will now be discovered, even if they do not exist

#### Dropped features

* sortby parameter
* Dropped "bar" and "list" support as values for the format parameter
** Dropped separator parameter support

#### Compatibility changes

* Changed MediaWiki compatibility from MW 1.17-1.19 to MW >= 1.19
* Changed PHP compatibility from 5.2.x to PHP >= 5.3.
* Changed Validator compatibility from 0.4.x to 1.0.x.
* New dependency: ParserHooks 0.1 or later.

#### Internal improvements

* Redesign of most of the code
* Added various PHPUnit tests
* Replaced manual class registration by a PST-0 style autoloader

#### Infrastructure

* Extension now be installed using [Composer](http://getcomposer.org)
* Unit tests can now be run using phpunit.xml.dist
* Tests now run [on TravisCI](https://travis-ci.org/wikimedia/mediawiki-extensions-SubPageList)
using different PHP versions, different MediaWiki versions and both MySQL and SQLite.
* Code coverage reports are generated on coveralls.io

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
