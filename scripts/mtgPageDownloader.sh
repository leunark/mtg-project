#!/bin/bash

destination=$1
checker='rel="last"'
counter=1

mkdir -p $destination
echo "Guaranteed existence of $destination"

rm -r $destination/*
echo "Emptied folder $destination"

echo "Started Downloading MTG Data ..."

curl -I -s -o .tmpheader https://api.magicthegathering.io/v1/cards?page=$counter

while grep -q $checker .tmpheader
do
	curl -s -o $destination/page$counter.json  https://api.magicthegathering.io/v1/cards?page=$counter
	echo "Downloaded Page $counter"

	((counter++))
	curl -I -s -o .tmpheader https://api.magicthegathering.io/v1/cards?page=$counter
done

curl -s -o $destination/page$counter.json  https://api.magicthegathering.io/v1/cards?page=$counter
echo "Downloaded Page $counter"

echo "All pages have been downloaded successfully!"
