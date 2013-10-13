# SubPageList usage instructions

These are the usage instructions for the [SubPageList extension](../README.md).

## Listing subpages

You have the choice to either use the tag extension <code><subpages /></code>
or use the parser function <code>{{#subpages: }}</code>. These take the
same parameters and behave identically.

### Parameters

#### Page

Parameter name: page

The page to show the subpages for. Defaults to the current page.

#### Format

Parameter name: format

Supported values:
<code>ol</code> for ordered lists (those with numbers),
<code>ul</code> for unordered lists (those with bullets).

Default: <code>ul</code>

#### Page name format

Parameter name: pathstyle

<table>
	<tr colspan="3">
		<th>Supported values</th>
	</tr>
	<tr>
		<th>Value</th>
		<th>Full page name</th>
		<th>Displayed name</th>
	</tr>
	<tr>
		<td>full</td>
		<td></td>
		<td></td>
	</tr>
</table>
Supported values:
<code>full</code>, ie Namespace:Foo/Bar/Baz
<code>nons</code>, ie Foo/Bar/Baz
<code>subpage</code>, Baz
<code>none</code>, ie
