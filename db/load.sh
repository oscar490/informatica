#!/bin/sh

BASE_DIR=$(dirname $(readlink -f "$0"))
if [ "$1" != "test" ]
then
    psql -h localhost -U informatica -d informatica < $BASE_DIR/informatica.sql
fi
psql -h localhost -U informatica -d informatica_test < $BASE_DIR/informatica.sql
