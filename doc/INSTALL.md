# SubPageList installation

These are the installation and configuration instructions for the [SubPageList extension](../README.md).

## Platform compatibility and release status

The PHP and MediaWiki version ranges listed are those in which SubPageList is known to work. SubPageList might also
work with more recent versions of PHP and MediaWiki, though this is not guaranteed. Increases of
minimum requirements are indicated in bold. For a detailed list of changes, see the [release notes](RELEASE-NOTES.md).

<table>
	<tr>
		<th>SubPageList</th>
		<th>PHP</th>
		<th>MediaWiki</th>
		<th>Release status</th>
	</tr>
	<tr>
		<th>1.6.x</th>
		<td><strong>7.1</strong> - 7.4</td>
		<td><strong>1.31</strong> - 1.33</td>
		<td><strong>Stable release</strong></td>
	</tr>
	<tr>
		<th>1.5.x</th>
		<td>5.5.0 - 7.1 & HHVM</td>
		<td>1.23 - 1.29</td>
		<td>Obsolete release</td>
	</tr>
	<tr>
		<th>1.4.x</th>
		<td><strong>5.5.0</strong> - 7.0 & HHVM</td>
		<td><strong>1.23</strong> - 1.28</td>
		<td>Obsolete release, no support</td>
	</tr>
	<tr>
		<th>1.2.x</th>
		<td>5.3.0 - 7.0 & HHVM</td>
		<td>1.19 - 1.27</td>
		<td>Obsolete release, no support</td>
	</tr>
	<tr>
		<th>1.1.x</th>
		<td>5.3.0 - 5.6.x & HHVM</td>
		<td>1.19 - 1.25</td>
		<td>Obsolete release, no support</td>
	</tr>
	<tr>
		<th>1.0.0</th>
		<td><strong>5.3.0</strong> - 5.5.x</td>
		<td><strong>1.19</strong> - 1.23</td>
		<td>Obsolete release, no support</td>
	</tr>
	<tr>
		<th>0.5.0</th>
		<td>5.2.0 - 5.5.x</td>
		<td>1.16 - 1.19</td>
		<td>Obsolete release, no support</td>
	</tr>
</table>

### Database support

<table>
	<tr>
		<th>SubPageList</th>
		<th>MySQL</th>
		<th>SQLite</th>
		<th>PostgreSQL</th>
	</tr>
	<tr>
		<th>1.x</th>
		<td>Full support</td>
		<td>Full support</td>
		<td>Unknown</td>
	</tr>
	<tr>
		<th>0.5.0</th>
		<td>Full support</td>
		<td>Unknown</td>
		<td>Unknown</td>
	</tr>
</table>

Other databases supported by MediaWiki might work as well, though this is not guaranteed.


## Installation

The recommended way to install the SubPageList extension is with [Composer](http://getcomposer.org) using
[MediaWikis built-in Composer support](https://www.mediawiki.org/wiki/Composer).

In your MediaWiki root directory, you can execute:

    composer require mediawiki/sub-page-list "~1.5"
    
For more details on extension installation via Composer, see the documentation on MediaWiki.org.

### Verify installation success


As final step, you can verify SubPageList got installed by looking at the Special:Version page on your wiki and verifying the
SubPageList extension is listed.

## Configuration

After you are done with installing, it is time to update your configuration.

Configuration of SubPageList is done by adding simple PHP statements to your
[LocalSettings.php](https://www.mediawiki.org/wiki/Manual:LocalSettings.php)
file. These statements need to be placed AFTER the inclusion of SubPageList.
The options are listed below and their default is set in the SubPageList
settings file. You should NOT modify the settings file, but can have a look
at it to get an idea of how to use the settings, in case the below descriptions
do not suffice.

### Required subpage settings

MediaWiki itself has some support for subpages, which causes back links
to be displayed on subpages to their parent pages. To enable this you
need to set [$wgNamespacesWithSubpages](https://www.mediawiki.org/wiki/Manual:$wgNamespacesWithSubpages),
which is a per namespace setting, like shown below:

```php
$GLOBALS['wgNamespacesWithSubpages'][NS_MAIN] = 1;
```

### Automatic refresh

MediaWiki by default caches the content of pages. This means that when you have
a sub page list, and one of the pages in this list gets moved or deleted, or a
new page is created that should show up in this list, the list will not be updated
automatically right away. You will need to wait for the cache to expire, or manually
purge the cache.

SubPageList comes with an option to automatically invalidate the cache of all pages
in a page tree when one of its pages gets modified. A page tree is a root page and
all of its children.

This option is off by default and can be turned on with:

```php
$GLOBALS['egSPLAutorefresh'] = true;
```
