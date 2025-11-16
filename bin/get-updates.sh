#!/bin/sh

i=0
while [ $((i+=1)) -lt 5 ]; do
  /home/artkolev/data/webserver/php/tgbot_symfony/bin/console app:get-updates
  echo 'Сон 10 сек'
  sleep 10
done
