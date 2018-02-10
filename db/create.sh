#!/bin/sh

if [ "$1" = "travis" ]
then
    psql -U postgres -c "CREATE DATABASE informatica_test;"
    psql -U postgres -c "CREATE USER informatica PASSWORD 'informatica' SUPERUSER;"
else
    [ "$1" != "test" ] && sudo -u postgres dropdb --if-exists informatica
    [ "$1" != "test" ] && sudo -u postgres dropdb --if-exists informatica_test
    [ "$1" != "test" ] && sudo -u postgres dropuser --if-exists informatica
    sudo -u postgres psql -c "CREATE USER informatica PASSWORD 'informatica' SUPERUSER;"
    [ "$1" != "test" ] && sudo -u postgres createdb -O informatica informatica
    sudo -u postgres createdb -O informatica informatica_test
    LINE="localhost:5432:*:informatica:informatica"
    FILE=~/.pgpass
    if [ ! -f $FILE ]
    then
        touch $FILE
        chmod 600 $FILE
    fi
    if ! grep -qsF "$LINE" $FILE
    then
        echo "$LINE" >> $FILE
    fi
fi
