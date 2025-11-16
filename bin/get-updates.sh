#!/bin/sh

i=0
while [ "$i" -lt 11 ]; do
  /home/artkolev/data/webserver/php/tgbot_symfony/bin/console app:get-updates
  echo 'Сон 5 сек'
  sleep 5
done
