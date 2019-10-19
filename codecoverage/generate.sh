#!/bin/bash

while true; do
    fdupes -dN coverages/
    ~/php5/bin/php -dzend_extension=xdebug.so -ddate.timezone="America/Toronto" combine_xdebug.php
done
