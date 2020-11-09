#!/usr/bin/env bash


export PHP=$(which php);
export SLEEP=$1;
[ -z "$1" ] && export SLEEP=7;

for x in ./*
	do
	clear;
	echo -e "Running example \"$x\" ...\n\n";
	$PHP $x;
	echo -e "\n\n";
	read -p "Press any key to run the next example ..."
done
