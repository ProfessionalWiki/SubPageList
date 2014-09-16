#! /bin/bash

set -x

originalDirectory=$(pwd)

cd ../phase3/tests/phpunit

if [ "$TYPE" == "coverage" ]
then
	php phpunit.php -c ../../extensions/SubPageList/phpunit.xml.dist --coverage-clover $originalDirectory/build/coverage.clover
else
	php phpunit.php -c ../../extensions/SubPageList/phpunit.xml.dist
fi