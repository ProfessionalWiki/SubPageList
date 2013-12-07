#! /bin/bash

set -x

cd ../phase3/extensions/SubPageList

if [ "$MW-$DBTYPE" == "master-mysql" ]
then
	phpunit --coverage-clover ../../extensions/SubPageList/build/logs/clover.xml
else
	phpunit
fi