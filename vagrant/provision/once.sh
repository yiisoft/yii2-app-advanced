#!/usr/bin/env bash

#== Import script args ==

github_token=$(echo "$1")
timezone=$(echo "$2")

#== Bash helpers ==

function info {
  echo " "
  echo "--> $1"
  echo " "
}

#== Provision script ==

info "Allocate swap for MySQL 5.6"
fallocate -l 2048M /swapfile
chmod 600 /swapfile
mkswap /swapfile
swapon /swapfile
echo '/swapfile none swap defaults 0 0' >> /etc/fstab

info "Configure locales"
sudo update-locale LC_ALL="C"
sudo dpkg-reconfigure locales

info "Configure timezone"
echo ${timezone} | sudo tee /etc/timezone
sudo dpkg-reconfigure --frontend noninteractive tzdata

info "Prepare root password for MySQL"
debconf-set-selections <<< "mysql-server-5.6 mysql-server/root_password password \"''\""
debconf-set-selections <<< "mysql-server-5.6 mysql-server/root_password_again password \"''\""
echo "Done!"

info "Update OS software"
sudo apt-get update
sudo apt-get upgrade -y

info "Install additional software"
sudo apt-get install -y git php5-cli php5-intl php5-mysqlnd php5-gd php5-fpm nginx mysql-server-5.6

info "Install nginx configuration"
sudo ln -s /app/vagrant/nginx/app.conf /etc/nginx/sites-enabled/app.conf
echo "Done!"

info "Initailize databases for MySQL"
mysql -uroot <<< "CREATE DATABASE yii2advanced"
echo "Done!"

info "Install composer"
curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer

info "Configure composer"
composer config --global github-oauth.github.com ${github_token}
echo "Done!"

info "Install plugins for composer"
composer global require "fxp/composer-asset-plugin:~1.1.1" --no-progress

info "Install project dependencies"
cd /app
composer --no-progress --prefer-dist install

info "Init project"
./init --env=Development --overwrite=y

info "Apply migrations"
./yii migrate <<< "yes"