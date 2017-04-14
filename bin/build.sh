#!/bin/bash

SCRIPT_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
ROOT_DIR=$(cd ${SCRIPT_DIR}/..; pwd)

source ${SCRIPT_DIR}/common.sh
trap "Exiting" SIGUSR1

cd ${ROOT_DIR} && docker-compose up -d --build --remove-orphans

sleep 10    # hack to allow services to start

bin/exec.sh composer install -vv
bin/exec.sh vendor/bin/phing docker.init

