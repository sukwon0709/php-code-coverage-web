#!/bin/bash

while true; do
    fdupes -dN coverages/
    php -ddate.timezone="America/Toronto" combine_xdebug.php
done
