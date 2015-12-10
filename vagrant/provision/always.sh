#!/usr/bin/env bash

#== Bash helpers ==

function info {
  echo " "
  echo "--> $1"
  echo " "
}

#== Provision script ==

info "Restart web-stack"
sudo service php5-fpm restart
sudo service nginx restart
sudo service mysql restart