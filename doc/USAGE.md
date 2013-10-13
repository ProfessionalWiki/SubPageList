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

### Default parameters

TODO

* page
* format
* pathstyle
* sort
 
### Examples

TODO

## Counting subpages

TODO
