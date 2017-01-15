#!/usr/bin/env bash

#== Bash helpers ==
source /app/vagrant/provision/common.sh

#== Import script args ==

github_token=$(echo "$1")
netmask=$(echo "$2")

#== Provision script ==

info "Provision-script user: `whoami`"

info "Configure composer"
composer config --global github-oauth.github.com ${github_token}
echo "Done!"

info "Install plugins for composer"
composer global require "fxp/composer-asset-plugin:^1.2.0" --no-progress
echo "Done!"

info "Install codeception"
composer global require "codeception/codeception=2.0.*" "codeception/specify=*" "codeception/verify=*" --no-progress
echo 'export PATH=/home/vagrant/.config/composer/vendor/bin:$PATH' | tee -a /home/vagrant/.profile
echo "Done!"

info "Install project dependencies"
cd /app
composer --no-progress --prefer-dist install
echo "Done!"

info "Init project"
php ./init --env=Development --overwrite=y
echo "Done!"

info "Apply migrations"
php ./yii migrate <<< "yes"
echo "Done!"

info "Create bash-alias 'app' for vagrant user"
echo 'alias app="cd /app"' | tee /home/vagrant/.bash_aliases
echo "Done!"

info "Enabling colorized prompt for guest console"
sed -i "s/#force_color_prompt=yes/force_color_prompt=yes/" /home/vagrant/.bashrc
echo "Done!"

info "Enabling access to GII from host ip"
sed  -i  '/return $config/d' ./frontend/config/main-local.php
cat <<EOT >> ./frontend/config/main-local.php
if (!YII_ENV_TEST && isset(\$config['modules']['gii']) )
    \$config['modules']['gii']['allowedIPs'] = ['127.0.0.1', '::1','${netmask}.1'];

return \$config;
EOT

echo "Done!"
