# SubPageList usage instructions

These are the usage instructions for the [SubPageList extension](../README.md).

## Listing subpages

You have the choice to either use the tag extension <code>&lt;subpages /></code>
or use the parser function <code>{{#subpages: }}</code>. These take the
same parameters and behave identically.

### Parameters

#### Page

Parameter name: page

The page to show the subpages for. Defaults to the current page.

#### List format

Parameter name: format

Supported values:
<code>ol</code> for ordered lists (those with numbers),
<code>ul</code> for unordered lists (those with bullets).

Default: <code>ul</code>

#### Page name format

Parameter name: pathstyle

This parameter controls how page titles are displayed in the list. The default is <code>subpagename</code>.

<table>
	<tr>
		<th colspan="3">Supported values</th>
	</tr>
	<tr>
		<th>Format</th>
		<th>Title: Namespace:Foo/Bar/Baz</th>
		<th>Title: Namespace:Title</th>
	</tr>
	<tr>
		<th>full</th>
		<td>Namespace:Foo/Bar/Baz</td>
		<td>Namespace:Title</td>
	</tr>
	<tr>
		<th>pagename</th>
		<td>Foo/Bar/Baz</td>
		<td>Title</td>
	</tr>
	<tr>
		<th>subpagename</th>
		<td>Baz</td>
		<td>Namespace:Title</td>
	</tr>
	<tr>
		<th>none</th>
		<td>Baz</td>
		<td>Title</td>
	</tr>
</table>

#### Sort

Parameter name: sort

Alphabetic sorting order of the pages. The allowed values are <code>asc</code> for ascending (A first)
and <code>desc</code> for descending (Z first). The default is <code>asc</code>.

#### Header and footer

Header parameter name: intro

Footer parameter name: outro

These parameters allow you to specify content to be placed before and after the list of sub pages.
This context can be simple wikitext. Footer and header are displayed within the same HTML element
(div, span, etc) the list itself is located in. They are also only shown if the list itself is shown.
This means header and footer will not be displayed if the list is empty.

#### Fallback value (default)

Parameter name: default

This parameter allows you to specify contents to display when the sub page list is empty. This could
be a message such as "There are no sub pages to list".

#### Link pages

Parameter name: links

This parameter specifies if the pages in the list should be links. The allowed values
are <code>yes</code> and <code>no</code>. The default is <code>yes</code>.

#### Displaying the page itself

Parameter name: showpage

This parameter indicates if the page itself should be displayed as part of the list.
The allowed values are <code>yes</code> and <code>no</code>. The default is <code>no</code>.

#### Only direct subpages

Parameter name: kidsonly

This parameter indicates if only direct children of the page should be included in the list.
The allowed values are <code>yes</code> and <code>no</code>. The default is <code>no</code>.

#### Template

Parameter name: template

Allows specifying a MediaWiki template to format the page names with. The template gets a
single unnamed parameter which is the page name. The format of the page name depends on the
<code>pathstyle</code> parameter.

#### Wrapping HTML element

Parameter name: element

Allowed values:

* div
* p
* span
 
Default: div

#### HTML element CSS class

Parameter name: class

Class of the wrapping HTML element. Default: <code>subpagelist</code>

### Default parameters

When using the parser function, a number of parameters can be provided without
specying their name. Those parameters are listed below, in order:

* page
* format
* pathstyle
* sort
 
This means you can do <code>{{#subpages:YourPageName|ol}}</code>
instead of <code>{{#subpages:page=YourPageName|format=ol}}</code>.

When using the tag extension, one can specify the name of the page to use by putting
it in between tags: <code>&lt;subpagelist>YourPageName&lt;subpagelist></code> rather
then using the named equivalent <code>&lt;subpagelist page="YourPageName" /></code>.
 
### Examples

TODO

## Counting subpages

TODO
