#!/bin/bash

filename=mtg_cards_final.csv
hdfsdir=/user/hadoop/mtg/final
filepath=/home/hadoop/mtg/final/$filename

if [ -e  $filepath ]
then
	hadoop fs -mkdir -p $hdfsdir
	hadoop fs -put -f $filepath $hdfsdir/$filename
	echo "File $filepath was moved to hdfs $hdfsdir/$filename"
else
	echo "File $filepath does not exist"
fi
