#!/bin/bash

hdfsdir=/user/hadoop/mtg/final

echo "Checking if directory $hdfsdir exists"

if ! $(hadoop fs -test -d $hdfsdir)
then 
	echo "Directory $hdfsdir doesnt exist" 
	hadoop fs -mkdir -p $hdfsdir
	echo "Created Directory $hdfsdir"
else 
	echo "Directory $hdfsdir exists"
	hadoop fs -rm -r $hdfsdir/*
	echo "Cleaned folder"
fi

