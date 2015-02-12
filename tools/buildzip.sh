#!/bin/bash

SCRIPT=$(readlink -f $0)
SCRIPTPATH=`dirname $SCRIPT`
cd $SCRIPTPATH

COMPRESSED_NAME="EmpathyApp.zip"

rm -rf $COMPRESSED_NAME > /dev/null
zip -r $COMPRESSED_NAME *
