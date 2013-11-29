# SubPageList installation

These are the installation and configuration instructions for the [SubPageList extension](../README.md).

## Versions

<table>
	<tr>
		<th></th>
		<th>Status</th>
		<th>Release date</th>
		<th>PHP</th>
		<th>MediaWiki</th>
		<th>Git branch</th>
		<th>Composer</th>
	</tr>
	<tr>
		<th><a href="https://github.com/JeroenDeDauw/SubPageList/blob/master/docs/RELEASE-NOTES.md">SPL 1.1.x</a></th>
		<td>Development version</td>
		<td>Estimate: December 2013</td>
		<td>5.3.2 - 5.5.x</td>
		<td>1.19 - 1.23</td>
		<td><a href="https://github.com/JeroenDeDauw/SubPageList/tree/master">master</a></td>
		<td>Required</td>
	</tr>
	<tr>
		<th>SPL 1.0</th>
		<td>Stable release</td>
		<td>2013-10-13</td>
		<td>5.3.0 - 5.5.x</td>
		<td>1.19 - 1.23</td>
		<td><a href="https://github.com/JeroenDeDauw/SubPageList/tree/1.0">1.0</a></td>
		<td>Supported</td>
	</tr>
	<tr>
		<th>SPL 0.5</th>
		<td>Legacy release</td>
		<td>2011-12-27</td>
		<td>5.2.0 - 5.5.x</td>
		<td>1.16 - 1.19</td>
		<td><a href="https://github.com/JeroenDeDauw/SubPageList/tree/0.5">0.5</a></td>
		<td>Not supported</td>
	</tr>
</table>

The PHP and MediaWiki version ranges listed are those in which SMW is known to work. It might also
work with more recent versions of PHP and MediaWiki, though this is not guaranteed.

### Database support

<table>
	<tr>
		<th></th>
		<th>MySQL</th>
		<th>SQLite</th>
		<th>PostgreSQL</th>
	</tr>
	<tr>
		<th>SPL 1.1.x</th>
		<td>Full support</td>
		<td>Full support</td>
		<td>Unknown</td>
	</tr>
	<tr>
		<th>SPL 1.0</th>
		<td>Full support</td>
		<td>Full support</td>
		<td>Unknown</td>
	</tr>
	<tr>
		<th>SPL 0.5</th>
		<td>Full support</td>
		<td>Unknown</td>
		<td>Unknown</td>
	</tr>
</table>

## Download and installation

The recommended way to download and install SubPageList is with [Composer](http://getcomposer.org) using
[MediaWiki 1.22 built-in support for Composer](https://www.mediawiki.org/wiki/Composer). MediaWiki
versions prior to 1.22 can use Composer via the
[Extension Installer](https://github.com/JeroenDeDauw/ExtensionInstaller/blob/master/README.md)
extension.

#### Step 1

If you have MediaWiki 1.22 or later, go to the root directory of your MediaWiki installation,
and go to step 2. You do not need to install any extensions to support composer.

For MediaWiki 1.21.x and earlier you need to install the
[Extension Installer](https://github.com/JeroenDeDauw/ExtensionInstaller/blob/master/README.md) extension.

Once you are done installing the Extension Installer, go to its directory so composer.phar
is installed in the right place.

    cd extensions/ExtensionInstaller

#### Step 2

If you have previously installed Composer skip to step 3.

To install Composer:

    wget http://getcomposer.org/composer.phar

#### Step 3

Now using Composer, install SubPageList

    php composer.phar require mediawiki/sub-page-list ~1.1

#### Verify installation success

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

### Automatic refresh

You can choose to automatically refresh subpage lists
that are on the base page of subpages you add, move or delete, or on one
of the subpages of the base page. This behaviour is off by default as it
can produce extra load on your server, but can be turned on with this code:

$GLOBALS['egSPLAutorefresh'] = true;

### General subpage settings

MediaWiki itself has some support for subpages, which causes back links
to be displayed on subpages to their parent pages. To enable this you
need to set [$wgNamespacesWithSubpages](https://www.mediawiki.org/wiki/Manual:$wgNamespacesWithSubpages),
which is a per namespace setting, like shown below:

$GLOBALS['wgNamespacesWithSubpages'][NS_MAIN] = 1;