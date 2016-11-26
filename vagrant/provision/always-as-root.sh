#!/usr/bin/env bash

#== Bash helpers ==
source /app/vagrant/provision/common.sh

#== Provision script ==

info "Provision-script user: `whoami`"

info "Restart web-stack"
service php5-fpm restart
service nginx restart
service mysql restart
