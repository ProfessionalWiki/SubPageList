# SubPageList Configuration

These are the configuration instructions for the [SubPageList extension](../README.md).

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