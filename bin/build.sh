#!/bin/bash

SCRIPT_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
ROOT_DIR=$(cd ${SCRIPT_DIR}/..; pwd)

source ${SCRIPT_DIR}/common.sh
trap "Exiting" SIGUSR1

if [ "$1" = "--help" ]; then
    echo "  ./build [mobilejazz_dir] [mobilejazz-contrib_dir]"
    echo "  [mobilejazz_dir] Optional directory path where all of your mobilejazz projects are checked out."
    echo "  [mobilejazz-contrib_dir] Optional directory path where all of your mobilejazz-contrib projects are checked out."
    exit
fi

docker pull mobilejazz/yii2-docker:apache-php5

export MOBILEJAZZ_DEV=${1-${ROOT_DIR}}
export MOBILEJAZZ_CONTRIB=${2-${ROOT_DIR}}

echo "MobileJazz projects dir: '$MOBILEJAZZ_DEV'";
echo "MobileJazz Contrib projects '$MOBILEJAZZ_CONTRIB'";

cd ${ROOT_DIR} && docker-compose up -d --build --remove-orphans

sleep 10    # hack to allow services to start

bin/exec.sh composer install -vv
bin/exec.sh vendor/bin/phing docker.init

