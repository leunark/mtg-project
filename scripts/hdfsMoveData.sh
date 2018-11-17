#!/bin/bash

filename=$1.csv
hdfsdir=$2/final
filepath=$3/final/$filename

if [ -e  $filepath ]
then
	hadoop fs -mkdir -p $hdfsdir
	hadoop fs -put -f $filepath $hdfsdir/$filename
	echo "File $filepath was moved to hdfs $hdfsdir/$filename"
else
	echo "File $filepath does not exist"
fi
