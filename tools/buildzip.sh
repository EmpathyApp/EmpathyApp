#!/bin/bash

# Keep me under tools/.

SCRIPT=$(readlink -f $0)
SCRIPTPATH=`dirname $SCRIPT`
cd $SCRIPTPATH
cd ..

COMPRESSED_NAME="EmpathyApp.zip"

rm -rf $COMPRESSED_NAME > /dev/null
zip --exclude "/tools*" -r $COMPRESSED_NAME *
